<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Color extends Model
{
    protected $table = 'product_colors';
    protected $fillable = [
        'name',
        'code'
    ]; 
}
