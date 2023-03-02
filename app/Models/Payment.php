<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Payment extends Model
{
    protected $table = 'payment';
    protected $fillable = [
      'user_id', 'product_id', 'payment_method', 'amount', 'payment_screenshot', 'status'
    ]; 
}
