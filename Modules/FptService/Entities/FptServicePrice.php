<?php

namespace Modules\FptService\Entities;


use Modules\Support\Eloquent\Model;

class FptServicePrice extends Model
{
    const TYPE_PROVINCE = 'province';
    const TYPE_DISTRICT = 'district';
    const TYPE_WARD = 'ward';

    protected $fillable = [
        'type',
        'price',
        'province_id',
        'district_id',
        'ward_id',
        'is_active',
    ];
}
