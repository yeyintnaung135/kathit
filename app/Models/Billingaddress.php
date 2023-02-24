<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Billingaddress extends Model
{
    protected $table = 'billing_address';
    protected $fillable = [
      'user_id', 'name', 'phone', 'email', 'address', 'state', 'city'
    ]; 
}
