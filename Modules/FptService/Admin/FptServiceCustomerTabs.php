<?php

namespace Modules\FptService\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;
use Modules\FptService\Entities\FptCategory;

class FptServiceCustomerTabs extends Tabs
{
    public function make()
    {
        $this->group('fpt_service_customers_information', trans('fptservice::fpt_service_customers.tabs.group.fpt_service_customers_information'))
            ->active()
            ->add($this->general());
    }

    private function general()
    {
        return tap(new Tab('general', trans('fptservice::fpt_service_customers.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(1);
            $tab->view('fptservice::admin.fpt_service_customers.tabs.general', []);
        });
    }
}
