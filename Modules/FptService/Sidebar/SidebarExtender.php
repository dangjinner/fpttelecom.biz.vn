<?php

namespace Modules\FptService\Sidebar;

use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Group;
use Modules\Admin\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('admin::sidebar.content'), function (Group $group) {
            $group->item(trans('fptservice::fpt_services.fpt_services'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(0);
                $item->authorize(
                    /* append */
                );

                $item->item(trans('fptservice::fpt_services.fpt_services'), function (Item $item) {
                    $item->weight(5);
                    $item->route('admin.fpt_services.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.fpt_services.index')
                    );
                });

                $item->item(trans('fptservice::fpt_categories.fpt_categories'), function (Item $item) {
                    $item->weight(5);
                    $item->route('admin.fpt_categories.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.fpt_categories.index')
                    );
                });

                $item->item(trans('fptservice::fpt_service_customers.fpt_service_customers'), function (Item $item) {
                    $item->weight(5);
                    $item->route('admin.fpt_service_customers.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.fpt_service_customers.index')
                    );
                });

// append



            });
        });
    }
}
