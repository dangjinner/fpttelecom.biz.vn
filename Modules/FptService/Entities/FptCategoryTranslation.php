<?php

namespace Modules\FptService\Entities;

use Modules\Support\Eloquent\TranslationModel;

class FptCategoryTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'info'];
}
