<?php

namespace Themes\Fpt\Admin;

use Modules\Admin\Ui\Tabs;
use Modules\Admin\Ui\Tab;
use Modules\FptService\Entities\FptCategory;
use Modules\Tag\Entities\Tag;
use Themes\Fpt\Banner;
use Modules\Menu\Entities\Menu;
use Modules\Page\Entities\Page;
use Modules\Media\Entities\File;
use Modules\Slider\Entities\Slider;
use Illuminate\Support\Facades\Cache;

class FptTabs extends Tabs
{
    /**
     * Make new tabs with groups.
     *
     * @return void
     */

    public function make()
    {
        $this->group('general_settings', trans('fpt::fpt.tabs.group.general_settings'))
            ->active()
            ->add($this->general())
            ->add($this->logo())
            ->add($this->menus())
            ->add($this->footer())
            ->add($this->socialLinks());

        $this->group('home_page_settings', trans('fpt::fpt.tabs.group.home_page_settings'))
            ->add($this->getHomePageBanner())
            ->add($this->getHomePageFeatures())
            ->add($this->getHomePageServices());

    }

    private function general()
    {
        return tap(new Tab('general', trans('fpt::fpt.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['fpt_slider', 'fpt_copyright_text']);
            $tab->view('admin.fpt.tabs.general', [
                'pages' => $this->getPages(),
                'sliders' => $this->getSliders(),
                'homes' => $this->getHomes()
            ]);
        });
    }

    private function getHomes()
    {
        $homes = [];
        foreach (\File::glob(app('stylist')->current()->getPath() . '/views/public/home/*.blade.php') as $filename) {
            $name = basename($filename, '.blade.php');
            $homes[$name] = $name;
        }
        return $homes;
    }

    private function getPages()
    {
        return Page::all()->pluck('name', 'id')
            ->prepend(trans('fpt::fpt.form.please_select'), '');
    }

    private function getSliders()
    {
        return Slider::all()->sortBy('name')->pluck('name', 'id')
            ->prepend(trans('fpt::fpt.form.please_select'), '');
    }

    private function logo()
    {
        return tap(new Tab('logo', trans('fpt::fpt.tabs.logo')), function (Tab $tab) {
            $tab->weight(10);
            $tab->view('admin.fpt.tabs.logo', [
                'favicon' => $this->getMedia(setting('fpt_favicon')),
                'headerLogo' => $this->getMedia(setting('fpt_header_logo')),
                'footerLogo' => $this->getMedia(setting('fpt_footer_logo')),
                'mailLogo' => $this->getMedia(setting('fpt_mail_logo')),
            ]);
        });
    }

    private function menus()
    {
        return tap(new Tab('menus', trans('fpt::fpt.tabs.menus')), function (Tab $tab) {
            $tab->weight(15);

            $tab->fields([
                'fpt_primary_menu',
                'fpt_category_menu',
                'fpt_footer_menu',
                'fpt_footer_menu_title',
            ]);

            $tab->view('admin.fpt.tabs.menus', [
                'menus' => $this->getMenus(),
            ]);
        });
    }

    private function getMenus()
    {
        return Menu::all()->pluck('name', 'id')
            ->prepend(trans('fpt::fpt.form.please_select'), '');
    }

    private function footer()
    {
        return tap(new Tab('footer', trans('fpt::fpt.tabs.footer')), function (Tab $tab) {
            $tab->weight(17);
            $tab->view('admin.fpt.tabs.footer', [
                'tags' => Tag::list(),
                'noticedGovImage' => $this->getMedia(setting('fpt_footer_noticed_gov_image')),
            ]);
        });
    }

    private function getMedia($fileId)
    {
        return Cache::rememberForever(md5("files.{$fileId}"), function () use ($fileId) {
            return File::findOrNew($fileId);
        });
    }

    private function socialLinks()
    {
        return tap(new Tab('social_links', trans('fpt::fpt.tabs.social_links')), function (Tab $tab) {
            $tab->weight(25);

            $tab->fields([
                'fpt_fb_link',
                'fpt_twitter_link',
                'fpt_instagram_link',
                'fpt_linkedin_link',
                'fpt_pinterest_link',
                'fpt_youtube_link',
            ]);

            $tab->view('admin.fpt.tabs.social_links');
        });
    }

    public function getHomePageBanner()
    {
        return tap(new Tab('home_page_banner', trans('fpt::fpt.tabs.home_page.banner')), function (Tab $tab) {
            $tab->weight(1);
            $tab->view('admin.fpt.tabs.home.banner', [
            ]);
        });
    }

    public function getHomePageFeatures()
    {
        $featureLogos = [];

        for ($i = 1; $i <= 5; $i++) {
            $featureLogos[$i] = $this->getMedia(setting("home_page_feature_{$i}_logo"));
        }

        return tap(new Tab('home_page_features', trans('fpt::fpt.tabs.home_page.features')), function (Tab $tab) use ($featureLogos) {
            $tab->weight(2);
            $tab->view('admin.fpt.tabs.home.features', [
                'featureLogos' => $featureLogos
            ]);
        });
    }

    public function getHomePageServices()
    {
        return tap(new Tab('home_page_services', trans('fpt::fpt.tabs.home_page.services')), function (Tab $tab) {
            $tab->weight(3);
            $tab->view('admin.fpt.tabs.home.services', [
                'fptCategories' => FptCategory::treeList()
            ]);
        });
    }
}
