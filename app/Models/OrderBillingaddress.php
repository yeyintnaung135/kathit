<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class OrderBillingaddress extends Model
{
    protected $table = 'order_billing_address';
    protected $fillable = [
      'user_id', 'payment_id', 'name', 'phone', 'email', 'address', 'state', 'city'
    ]; 
}
