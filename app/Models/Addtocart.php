<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Addtocart extends Model
{
    protected $table = 'addtocart';
    protected $fillable = [
      'user_id', 'product_id', 'color_id', 'readytowear_size', 'order_dress_customize_id', 'order_suit_customize_id', 'count','price_per_product'
    ]; 
}
