<?php

namespace Themes\Fpt\Http\ViewComposer;

use Illuminate\Support\Facades\Cache;
use Modules\Category\Entities\Category;
use Modules\Media\Entities\File;
use Modules\Menu\MegaMenu\MegaMenu;

class FptViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose($view)
    {
        $view->with([
            'headerLogo' => $this->getMedia(setting('fpt_header_logo')),
            'footerLogo' => $this->getMedia(setting('fpt_footer_logo')),
            'favicon' => $this->getMedia(setting('fpt_favicon')),
            'primaryMenu' => $this->getPrimaryMenu(),
        ]);
    }

    private function getMedia($fileId)
    {
        return Cache::rememberForever(md5("files.{$fileId}"), function () use ($fileId) {
            return File::findOrNew($fileId);
        });
    }

    private function getPrimaryMenu()
    {
        return new MegaMenu(setting('fpt_primary_menu'));
    }
}
