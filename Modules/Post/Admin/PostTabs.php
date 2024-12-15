<?php

namespace Modules\Post\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;
use Modules\FptService\Entities\FptCategory;
use Modules\Group\Entities\Group;

class PostTabs extends Tabs
{
    public function make()
    {
        $this->group('post_information', trans('post::posts.tabs.group.post_information'))
            ->active()
            ->add($this->general())
            ->add($this->shortcode())
            ->add($this->images())
            ->add($this->seo());
    }

    private function general()
    {
        return tap(new Tab('general', trans('post::posts.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['name']);
            $tab->view('post::admin.posts.tabs.general',[
                'groups' => Group::treeList(),
            ]);
        });
    }

    private function shortcode()
    {
        return tap(new Tab('shortcode', trans('post::posts.tabs.shortcode')), function (Tab $tab) {
            $tab->weight(5);
            $tab->view('post::admin.posts.tabs.shortcode',[
                'fptCategories' => FptCategory::treeList(),
            ]);
        });
    }

    private function images()
    {
        if (! auth()->user()->hasAccess('admin.media.index')) {
            return;
        }

        return tap(new Tab('images', trans('post::posts.tabs.images')), function (Tab $tab) {
            $tab->weight(10);
            $tab->view('post::admin.posts.tabs.images');
        });
    }

    private function seo()
    {
        return tap(new Tab('seo', trans('post::posts.tabs.seo')), function (Tab $tab) {
            $tab->weight(15);
            $tab->fields(['slug']);
            $tab->view('post::admin.posts.tabs.seo');
        });
    }
}
