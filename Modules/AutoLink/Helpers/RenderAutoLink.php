<?php

namespace Modules\AutoLink\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\AutoLink\Entities\AutoLink;

class RenderAutoLink
{
    public static function handle($content, $pageType = true)
    {
        $autoLinks = AutoLink::all();

        // Tách phần <div id="toc-header"> để không thay thế nội dung trong phần này
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); // Để xử lý các lỗi cảnh báo khi tải HTML
        $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
        $xpath = new \DOMXPath($dom);
        $nodeList = $xpath->query('//div[contains(@class, "widget-toc")]');

        if ($nodeList->length > 0) {
            $widgetTocContent = $dom->saveHTML($nodeList->item(0));

            // Duyệt qua các thẻ và xóa nội dung bên trong
            foreach ($nodeList as $tocDiv) {
                // Xóa tất cả các con (child) của thẻ div
                while ($tocDiv->firstChild) {
                    $tocDiv->removeChild($tocDiv->firstChild);
                }
            }
        }

        // Lấy lại nội dung HTML đã chỉnh sửa
        $content = html_entity_decode($dom->saveHTML());

        // Mảng lưu trữ các vùng đã thay thế
        $replacedRanges = [];

        foreach ($autoLinks as $autoLink) {
            if ($pageType === AutoLink::RENDER_FOR_PAGE && $autoLink->for_page
                || ($pageType === AutoLink::RENDER_FOR_POST && $autoLink->for_post
                    || (is_bool($pageType) && $pageType)
                )
            ) {
                // Prevent duplicate links
                $limit = $autoLink->is_duplicate ? $autoLink->limit + 1 : 1;

                $keywords = explode(',', $autoLink->title);

                foreach ($keywords as $keyword) {
                    $keyword = trim($keyword);

                    if (empty($keyword)) continue;

                    $keywordPattern = '/' . preg_quote($keyword, '/') . '/i';

                    // Tìm tất cả các vị trí xuất hiện của keyword
                    preg_match_all($keywordPattern, $content, $matches, PREG_OFFSET_CAPTURE);

                    $totalMatches = count($matches[0]);

                    // Nếu số lần xuất hiện ít hơn hoặc bằng limit, thay thế tất cả
                    if ($totalMatches <= $limit) {
                        $content = preg_replace_callback($keywordPattern, function ($matches) use ($autoLink, $content, &$replacedRanges) {
                            $replacement = $autoLink->getUrl($matches[0]);
                            $offset = strpos($content, $matches[0]);

                            // Lưu vùng đã thay thế
                            if ($offset !== false) {
                                $replacedRanges[] = ['start' => $offset, 'end' => $offset + strlen($replacement)];
                            }

                            return $replacement;
                        }, $content, $limit);
                    } else {
                        // Tính toán các vị trí cần thay thế một cách đồng đều
                        $selectedIndexes = [];
                        for ($i = 0; $i < $limit; $i++) {
                            $index = ceil(($i + 1) * $totalMatches / ($limit + 1)) - 1;
                            $index = max(0, min($index, $totalMatches - 1));
                            $selectedIndexes[] = $index;
                        }

                        // Loại bỏ các chỉ số trùng lặp và sắp xếp giảm dần
                        $selectedIndexes = array_unique($selectedIndexes);
                        rsort($selectedIndexes);

                        foreach ($selectedIndexes as $index) {
                            $match = $matches[0][$index];
                            $matchedText = $match[0];
                            $offset = $match[1];

                            // Kiểm tra chồng lấn vùng đã thay thế
                            if (!self::isOverlapping($offset, strlen($matchedText), $replacedRanges)) {
                                $replacement = $autoLink->getUrl($matchedText);
                                $content = substr_replace($content, $replacement, $offset, strlen($matchedText));

                                // Lưu lại vùng đã thay thế
                                $replacedRanges[] = ['start' => $offset, 'end' => $offset + strlen($replacement)];
                            }
                        }
                    }
                }
            }
        }

        // Thêm lại nội dung trong widget-toc
        if (isset($widgetTocContent)) {
            $tocPattern = '/<div[^>]*class="[^"]*\bwidget-toc\b[^"]*"[^>]*><\/div>/is';
            $content = preg_replace($tocPattern, $widgetTocContent, $content);
        }

        $removeLinkInHeadingsPattern = '/<h([1-6])([^>]*)>(.*?)<\/h[1-6]>/is';
        $content = preg_replace_callback($removeLinkInHeadingsPattern, function ($matches) {
            // Loại bỏ thẻ <a> trong nội dung thẻ tiêu đề nhưng giữ lại nội dung
            $headingContent = preg_replace('/<a[^>]*>(.*?)<\/a>/is', '$1', $matches[3]);

            // Trả về thẻ tiêu đề đã loại bỏ thẻ <a> nhưng giữ lại các thuộc tính và nội dung, không cố định thẻ h1
            return "<h{$matches[1]}{$matches[2]}>{$headingContent}</h{$matches[1]}>";
        }, $content);

        // Xử lý lỗi khi sử dụng DOMDocument nếu có
        libxml_clear_errors();

        return $content;
    }

    private static function isOverlapping($offset, $length, $ranges) {
        $endOffset = $offset + $length;
        foreach ($ranges as $range) {
            if ($offset < $range['end'] && $endOffset > $range['start']) {
                return true;
            }
        }
        return false;
    }
}