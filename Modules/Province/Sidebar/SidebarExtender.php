<?php

namespace Modules\Province\Sidebar;

use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Group;
use Modules\Admin\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
         $menu->group(trans('admin::sidebar.content'), function (Group $group) {
             $group->item(trans('area::areas.areas'), function (Item $item) {
                  $item->item(trans('province::provinces.provinces'), function (Item $item) {
                     $item->weight(5);
                     $item->route('admin.provinces.index');
                     $item->authorize(
                         $this->auth->hasAccess('admin.provinces.index')
                     );
                 });
             });
         });
    }
}
