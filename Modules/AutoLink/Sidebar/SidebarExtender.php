<?php

namespace Modules\AutoLink\Sidebar;

use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Group;
use Modules\Admin\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('admin::sidebar.content'), function (Group $group) {
            $group->item(trans('autolink::auto_links.auto_links'), function (Item $item) {
                $item->icon('fa fa-link');
                $item->route('admin.auto_links.index');
                $item->weight(0);
                $item->authorize(
                    $this->auth->hasAccess('admin.auto_links.index')
                );
            });
        });
    }
}
