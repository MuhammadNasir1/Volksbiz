<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    public $table = "reviews";
    public $timestamp = true;
    public $fillable = [
        'status',
        'user_id',
        'rating',
        'location',
        'description',
    ];
}
