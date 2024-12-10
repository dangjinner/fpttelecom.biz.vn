<?php

namespace Modules\FptService\Entities;

use Illuminate\Database\Eloquent\Model;

class FptServiceCategory extends Model
{
    protected $fillable = ['fpt_service_id', 'fpt_category_id'];
}
