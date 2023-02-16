<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ContactMessage extends Model
{
    protected $table = 'contact_message';
    protected $fillable = [
        'name','phone', 'email', 'message'
    ]; 
}
