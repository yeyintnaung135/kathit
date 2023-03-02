<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class OrderProduct extends Model
{
    protected $table = 'order_product';
    protected $fillable = [
        'user_id',
        'product_id',
        'payment_id',
        'count',
        'color_id',
        'readytowear_size'
    ];
    public function product() {
      return $this->belongsTo('App\Models\Product','product_id');
    }
    public function color() {
      return $this->belongsTo('App\Models\Color','color_id');
    }
}
