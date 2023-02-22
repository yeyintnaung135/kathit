<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    protected $table = 'product_photos';
    protected $fillable = ['product_id','product_image','deleted_at'];

    public function getProductPhotos()
    {
      return $this->hasMany(ProductPhoto::class,'product_id');
    }


}
