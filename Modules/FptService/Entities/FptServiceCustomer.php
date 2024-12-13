<?php

namespace Modules\FptService\Entities;

use HoangPhi\VietnamMap\Models\Ward;
use Modules\Core\Entities\District;
use Modules\Core\Entities\Province;
use Modules\FptService\Admin\FptServiceCustomerTable;
use Modules\Support\Eloquent\Model;
use Modules\Support\Eloquent\Translatable;

class FptServiceCustomer extends Model
{
    const PROPERTY_TYPE_HOUSE = 1;
    const PROPERTY_TYPE_APARTMENT = 2;

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

    protected static function booted()
    {
        static::saving(function (FptServiceCustomer $fptServiceCustomer) {
            self::saveAddress($fptServiceCustomer);
        });
    }

    public function fptService()
    {
        return $this->belongsTo(FptService::class, 'fpt_service_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id');
    }

    public static function saveAddress(FptServiceCustomer &$fptServiceCustomer)
    {
        $ward = $fptServiceCustomer->ward()->first();
        $district = $fptServiceCustomer->district()->first();
        $province = $fptServiceCustomer->province()->first();

        $parts = [];

        // Thêm từng phần địa chỉ nếu tồn tại
        if ($ward) {
            $parts[] = $ward->name;
        }
        if ($district) {
            $parts[] = $district->name;
        }
        if ($province) {
            $parts[] = $province->name;
        }

        // Nối các phần địa chỉ cơ bản
        $baseAddress = implode(', ', $parts);

        // Thêm địa chỉ cụ thể tùy thuộc vào loại tài sản
        if ($fptServiceCustomer->property_type == self::PROPERTY_TYPE_HOUSE && !empty($fptServiceCustomer->home_address)) {
            $baseAddress =  "{$fptServiceCustomer->home_address}, {$baseAddress}";
        } elseif (!empty($fptServiceCustomer->building_name) && !empty($fptServiceCustomer->apartment_name)) {
            $baseAddress = "{$fptServiceCustomer->building_name}, {$fptServiceCustomer->apartment_name}, {$baseAddress}";
        }

        $fptServiceCustomer->address = $baseAddress;
    }

    public function getServiceAttribute()
    {
        $fptService = $this->fptService()->first();
        if ($fptService) {
            return $fptService->name;
        }

        return '';
    }
}
