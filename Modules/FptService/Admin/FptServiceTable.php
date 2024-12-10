<?php

namespace Modules\FptService\Admin;

use Modules\Admin\Ui\AdminTable;
use Modules\FptService\Entities\FptService;

class FptServiceTable extends AdminTable
{
    protected $rawColumns = ['price'];

    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable()
            ->addColumn('logo', function (FptService $fptService) {
                return view('admin::partials.table.image', [
                    'file' => $fptService->logo,
                ]);
            })
            ->addColumn('price', function (FptService $fptService) {
                return "<span class='text-red'>{$fptService->price->format()}</span>";
            });
    }
}
