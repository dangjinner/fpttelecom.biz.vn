<?php

namespace Modules\Support;

use NumberFormatter;
use Modules\Setting\Entities\Setting;

class Theme
{

    public static function all()
    {
        $array = [];
        $themes = app('stylist')->themes();

        foreach ($themes as $key => $value) {
            $array[ $value->getName() ] = $value->getName(); //$value->getName()
        }
        return $array;
    }


}
