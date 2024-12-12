<?php

namespace Modules\FptService\Entities;

use Modules\FptService\Admin\FptServiceCustomerTable;
use Modules\Support\Eloquent\Model;
use Modules\Support\Eloquent\Translatable;

class FptServiceCustomer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fpt_service_id',
        'name',
        'email',
        'phone_number',
        'home_address',
        'address',
        'apartment_name',
        'building_name',
        'floor_number',
        'room_number',
        'note',
        'property_type',
        'province_id',
        'district_id',
        'ward_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Get table data for the resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function table()
    {
        return new FptServiceCustomerTable($this->newQuery()
            ->latest()
            ->withoutGlobalScope('active'));
    }

    public function fptService()
    {
        return $this->belongsTo(FptService::class, 'fpt_service_id');
    }
}
