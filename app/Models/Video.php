<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Video extends Model
{
    protected $table = 'videos';
    protected $fillable = [
        'title',
        'video'
    ]; 
}
