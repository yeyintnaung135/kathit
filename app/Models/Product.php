<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'customize_price',
        's_price',
        'm_price',
        'l_price',
        'xl_price',
        'xxl_price',
        'brand_code',
        'category_id',
        'short_desc',
        'description',
        'type',
        'color',
        'deleted_at'
    ];

    public function getProductPhotos()
    {
        return $this->hasMany(ProductPhoto::class,'product_id');
    }
}
