<?php

namespace Modules\Product\Http\Controllers\Admin;

use Modules\Product\Entities\Product;
use Modules\Admin\Traits\HasCrudActions;
use Modules\Product\Http\Requests\SaveProductRequest;
use Illuminate\Http\Request;

class ProductController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'product::products.product';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'product::admin.products';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveProductRequest::class;

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        for($i = 0; $i < 30; $i++) {
            if ($request->has('review_questions_id')
                && $request->review_questions_id != null
                && count($request->review_questions_id) > 0 ) {
                $request->merge([
                    'review_questions_id' => json_encode($this->getRequest('store')->review_questions_id),
                ]);
            }


            $this->disableSearchSyncing();

            $entity = $this->getModel()->create(
                $this->getRequest('store')->all()
            );
            $this->searchable($entity);

            if (method_exists($this, 'redirectTo')) {
                return $this->redirectTo($entity);
            }
//        }

        return redirect()->route("{$this->getRoutePrefix()}.index")
            ->withSuccess(trans('admin::messages.resource_saved', ['resource' => $this->getLabel()]));
    }

    public function update($id, Request $request)
    {
        if ($request->has('review_questions_id')
            && $request->review_questions_id != null
            && count($request->review_questions_id) > 0 ) {
                $request->merge([
                    'review_questions_id' => json_encode($this->getRequest('update')->review_questions_id),
                ]);
        }

        // dd($this->getRequest('update')->all());
        $entity = $this->getEntity($id);
        $this->disableSearchSyncing();

        $entity->update(
            $this->getRequest('update')->all()
        );
        $this->searchable($entity);

        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($entity)
                ->withSuccess(trans('admin::messages.resource_saved', ['resource' => $this->getLabel()]));
        }

        return redirect()->route("{$this->getRoutePrefix()}.index")
            ->withSuccess(trans('admin::messages.resource_saved', ['resource' => $this->getLabel()]));
    }

    public function dinning(Request $request)
    {
        if ($request->has('query')) {
            return $this->getModel()
                ->search($request->get('query'))
                ->query()
                ->limit($request->get('limit', 10))
                ->get();
        }
        if ($request->has('dinning')) {
            return $this->getModel()->tableDinning($request);
        }

        return view("product::admin.products.indexDinning");
    }

    public function menu(Request $request)
    {
        if ($request->has('query')) {
            return $this->getModel()
                ->search($request->get('query'))
                ->query()
                ->limit($request->get('limit', 10))
                ->get();
        }
        if ($request->has('menu')) {
            return $this->getModel()->tableMenu($request);
        }

        return view("product::admin.products.indexMenu");
    }
}
