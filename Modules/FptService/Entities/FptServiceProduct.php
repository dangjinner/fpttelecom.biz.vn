<?php

namespace Modules\FptService\Entities;

use Illuminate\Database\Eloquent\Model;

class FptServiceProduct extends Model
{
    protected $fillable = [
        'fpt_service_id',
        'product_id',
    ];
}
