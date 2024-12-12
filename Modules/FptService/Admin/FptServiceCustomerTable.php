<?php

namespace Modules\FptService\Admin;

use Modules\Admin\Ui\AdminTable;
use Modules\FptService\Entities\FptServiceCustomer;

class FptServiceCustomerTable extends AdminTable
{
    protected $rawColumns = ['service'];

    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable()
            ->addColumn('service', function (FptServiceCustomer $fptServiceCustomer) {
                if ($fptServiceCustomer->fptService) {
                    $url = route('admin.fpt_services.edit', ['id' => $fptServiceCustomer->fptService->id]);
                    return "<a href='{$url}'>{$fptServiceCustomer->fptService->name}</a>";
                }
                return '';
            });
    }
}
