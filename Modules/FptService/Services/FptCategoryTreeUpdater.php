<?php

namespace Modules\FptService\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class FptCategoryTreeUpdater
{
    public static function update(array $tree)
    {
        list($ids, $parentIdCases, $positionCases, $params) = static::getDataForQuery($tree);

        $sql = "UPDATE `fpt_categories` SET
            `parent_id` = CASE `id` {$parentIdCases} END,
            `position` = CASE `id` {$positionCases} END,
            `updated_at` = ?
        WHERE `id` IN ({$ids})";

        DB::update($sql, $params);

        Cache::tags('fpt_categories')->flush();
    }

    private static function getDataForQuery(array $tree)
    {
        $params = [];
        $ids = [];

        foreach (static::getAttributesList($tree) as $id => $values) {
            foreach ($values as $column => $value) {
                $cases[$column][] = "WHEN {$id} THEN ?";
                $params[$column][] = $value;
            }

            $ids[] = $id;
        }

        return static::prepareData($ids, $cases, $params);
    }

    private static function getAttributesList(array $tree)
    {
        $attributes = [];

        foreach ($tree as $position => $post) {
            $attributes[$post['id']] = [
                'parent_id' => $post['parent_id'],
                'position' => $position,
            ];
        }

        return $attributes;
    }

    private static function prepareData(array $ids, array $cases, array $params)
    {
        $ids = implode(',', $ids);
        $parentIdCases = implode(' ', $cases['parent_id']);
        $positionCases = implode(' ', $cases['position']);

        $params = array_flatten($params);
        $params[] = Carbon::now();

        return [$ids, $parentIdCases, $positionCases, $params];
    }
}