<?php

namespace App\Models;

use App\Mail\ContactMail;
use Mail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    
    protected $table = 'contact_us';
    protected $fillable = [
        'address','phone', 'email'
    ]; 

    public static function boot () {
      parent::boot();
      static::created(function ($item) {
        // $adminEmail ="nyeinyadanartun.moe@gmail.com";
        $adminEmail ="bebesofia047@gmail.com";
        Mail::to($adminEmail)->send(new ContactMail($item));
      });
    }
}
