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
        'product_image',
        'price',
        'category_id',
        'short_desc',
        'description',
        'deleted_at'
    ]; 

    // public function getProductPhotos()
    // {
    //     return $this->hasMany(ProductGallery::class,'product_id');
    // }
    // public function category() {
    //     return $this->belongsTo('App\Categories','category_id');
    // }
    // public function discount() {
    //   return $this->hasOne('App\Discount','product_id');
    // }


}