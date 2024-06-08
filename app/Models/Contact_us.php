<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_us extends Model
{
    use HasFactory;
    public $table = "contact_us";
    public $timestamp = true;
    public $fillable = [
        'name',
        'email',
        'subject',
        'message',

    ];
}
