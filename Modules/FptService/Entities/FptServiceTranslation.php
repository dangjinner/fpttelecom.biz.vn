<?php

namespace Modules\FptService\Entities;

use Modules\Support\Eloquent\TranslationModel;

class FptServiceTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'features', 'billing_cycle', 'promotion_details'];
}
