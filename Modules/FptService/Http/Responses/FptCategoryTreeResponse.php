<?php

namespace Modules\FptService\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class FptCategoryTreeResponse implements Responsable
{
    /**
     * Groups collection.
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    private $fptCategories;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\Database\Eloquent\Collection $fptCategories
     */
    public function __construct($fptCategories)
    {
        $this->fptCategories = $fptCategories;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return response()->json($this->transform());
    }

    /**
     * Transform the fptCategories.
     *
     * @return \Illuminate\Support\Collection
     */
    private function transform()
    {
        return $this->fptCategories->map(function ($fptCategory) {
            return [
                'id' => $fptCategory->id,
                'parent' => $fptCategory->parent_id ?: '#',
                'text' => $fptCategory->name,
                'data' => [
                    'position' => $fptCategory->position,
                ],
            ];
        });
    }
}
