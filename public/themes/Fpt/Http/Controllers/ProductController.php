<?php

namespace Themes\Fpt\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Attribute\Entities\Attribute;
use Modules\Category\Entities\Category;

class ProductController
{
    public function show()
    {
        
    }

    public function ajaxCategory($slug, Request $request)
    {
        $category = Category::findBySlug($slug);

        $products = $category->products()->filterBrand($request->brand)
            ->filterCategory($request->category)
            ->filterContactPrice($request->contactPrice)
            ->sortBy($request->orderBy)
            ->price($request->fromPrice, $request->toPrice);

        $attributes = Attribute::all();

        foreach ($request->all() as $key => $req) {
            foreach ($attributes as $attribute) {
                if ($attribute->slug == $key) {
                    foreach ($attribute->values as $value) {
                        if ($value->id == $req) {
                            $productsId = [];
                            foreach ($value->products()->get() as $attributeValue) {
                                $productsId[] = $attributeValue->product_id;
                            }
                            $products = $products->whereIn('id', $productsId);
                        }
                    }
                }
            }
        }

        return $products->paginate(20);
    }
}