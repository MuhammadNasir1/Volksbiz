<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    public $timestamps = true;
    public $fillable = [
        'status',
        'user_id',
        'location',
        'subject',
        'category',
        'description',
        'image',
        'name',
        'role',

    ];
}
