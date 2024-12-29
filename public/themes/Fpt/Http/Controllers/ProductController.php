<?php

namespace Themes\Fpt\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Modules\Attribute\Entities\Attribute;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Product\Events\ProductViewed;
use Modules\Product\RecentlyViewed;

class ProductController
{
    public function show($slug, RecentlyViewed $recentlyViewed)
    {
        $product = Product::findHiddenBySlug($slug);
        $product->load('crossSellProducts', 'upSellProducts', 'relatedProducts', 'reviews');
        $productsRecentlyViewed = $recentlyViewed->products();
        $relatedProducts = $product->getRelatedProductCat($product->categories->pluck('id')->toArray());
        $sameVersionProducts = $product->sameVersionProducts()->get();

        event(new ProductViewed($product));

        $breadcrumb = $this->getCategoryBreadCrumb($product->categories->nest());

        $data = [
            'product' => $product,
            'breadcrumb' => $breadcrumb,
            'productsRecentlyViewed' => $productsRecentlyViewed,
            'relatedProducts' => $relatedProducts,
            'sameVersionProducts' => $sameVersionProducts->toArray(),
        ];

        SEOMeta::setTitle($product->translation->name);
        SEOMeta::setDescription($product->translation->name);
        SEOMeta::addKeyword($product->translation->name);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::twitter()->setSite(route('home'));

        return view('public.products.show', $data);
    }

    private function getCategoryBreadCrumb(Collection $categories)
    {
        $breadcrumb = '';

        foreach ($categories as $category) {
            $breadcrumb .= "<a href='". $category->url() ."'>{$category->name}</a><span> » </span>";

            if ($category->items->isNotEmpty()) {
                $breadcrumb .= $this->getCategoryBreadCrumb($category->items);
            }
        }
        return $breadcrumb;
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