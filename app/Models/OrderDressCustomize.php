<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class OrderDressCustomize extends Model
{
    protected $table = 'dress_customize';
    protected $fillable = [
        'user_id',
        'product_id',
        'measurement',
        'shoulder',
        'chest',
        'bust',
        'waist',
        'hips',
        'neck',
        'sleeve',
        'length',
        'waist_to_floor'
    ]; 
}
