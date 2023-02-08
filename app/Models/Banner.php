<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Banner extends Model
{
    protected $table = 'banners';
    protected $fillable = [
        'image'
    ]; 
}
