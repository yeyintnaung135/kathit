<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class OrderSuitCustomize extends Model
{
    protected $table = 'order_suit_customize';
    protected $fillable = [
        'user_id',
        'product_id',
        'payment_id',
        'measurement',
        'shoulder',
        'chest',
        'neck',
        'sleeve',
        'top_length',
        'waist',
        'hips',
        'pants_length',
        'thigh_length',
        'leg_opening',
        'inseam'
    ]; 
}
