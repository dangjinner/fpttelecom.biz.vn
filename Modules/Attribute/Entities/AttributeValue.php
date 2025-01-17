<?php

namespace Modules\Attribute\Entities;

use Modules\Support\Eloquent\Model;
use Modules\Support\Eloquent\Translatable;
use Modules\Product\Entities\Product;
use Modules\Attribute\Entities\ProductAttribute;
class AttributeValue extends Model
{
    use Translatable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['position'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['value'];

    public function products()
    {
        return $this->belongsToMany(ProductAttribute::class, 'product_attribute_values', 'attribute_value_id');
    }

   
}
