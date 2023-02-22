<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SuitCustomize extends Model
{
    protected $table = 'suit_customize';
    protected $fillable = [
        'user_id',
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
