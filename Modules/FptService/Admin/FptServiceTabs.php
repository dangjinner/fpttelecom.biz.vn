<?php

namespace Modules\FptService\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;
use Modules\FptService\Entities\FptCategory;

class FptServiceTabs extends Tabs
{
    public function make()
    {
        $this->group('fpt_services_information', trans('fptservice::fpt_services.tabs.group.fpt_services_information'))
            ->active()
            ->add($this->general())
            ->add($this->price())
            ->add($this->images())
            ->add($this->products());
    }

    private function general()
    {
        return tap(new Tab('general', trans('fptservice::fpt_services.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(1);
            $tab->fields(['name', 'description', 'features']);
            $tab->view('fptservice::admin.fpt_services.tabs.general', [
                'fptCategories' => FptCategory::treeList()
            ]);
        });
    }

    private function price()
    {
        return tap(new Tab('price', trans('fptservice::fpt_services.tabs.price')), function (Tab $tab) {
            $tab->weight(2);
            $tab->fields(['price']);
            $tab->view('fptservice::admin.fpt_services.tabs.price');
        });
    }

    private function images()
    {
        return tap(new Tab('images', trans('fptservice::fpt_services.tabs.images')), function (Tab $tab) {
            $tab->weight(3);
            $tab->fields(['price']);
            $tab->view('fptservice::admin.fpt_services.tabs.images');
        });
    }

    private function products()
    {
        return tap(new Tab('products', trans('fptservice::fpt_services.tabs.products')), function (Tab $tab) {
            $tab->weight(4);
            $tab->view('fptservice::admin.fpt_services.tabs.products');
        });
    }
}
