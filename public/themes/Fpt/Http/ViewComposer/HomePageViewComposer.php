<?php

namespace Themes\Fpt\Http\ViewComposer;

use Illuminate\Support\Facades\Cache;
use Modules\Category\Entities\Category;
use Modules\Media\Entities\File;
use Modules\Menu\MegaMenu\MegaMenu;
use Modules\Slider\Entities\Slider;

class HomePageViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose($view)
    {
        $view->with([
            'banner' => Slider::findWithSlides(setting('home_page_banner')),
            'mobileBanner' => Slider::findWithSlides(setting('home_page_mobile_banner')),
            'features' => $this->getFeatures()
        ]);
    }

    private function getMedia($fileId)
    {
        return Cache::rememberForever(md5("files.{$fileId}"), function () use ($fileId) {
            return File::findOrNew($fileId);
        });
    }

    private function getFeatures()
    {
        $features = [];
        for($i = 1; $i <= 4; $i++) {
            $features[] = [
                'logo' => $this->getMedia(setting("home_page_feature_{$i}_logo")),
                'name' => setting("home_page_feature_{$i}_name"),
                'desc' => setting("home_page_feature_{$i}_desc"),
                'url' => setting("home_page_feature_{$i}_url"),
            ];
        }

        return $features;
    }
}
