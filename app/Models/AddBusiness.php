<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddBusiness extends Model
{
    use HasFactory;
    public $table = "businesses";
    public $timestamps = false;

    protected  $fillable = [
        'images',
        'video',
        'category',
        'title',
        'country',
        'city',
        'description',
        'price',
    ];
}
