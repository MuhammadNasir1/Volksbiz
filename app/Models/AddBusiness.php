<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddBusiness extends Model
{
    use HasFactory;
    public $table = "businesses";
    public $timestamps = true;

    protected  $fillable = [
        'user_id',
        'images',
        'video',
        'category',
        'title',
        'title_de',
        'country',
        'city',
        'description',
        'description_de',
        'price',
        'status',
    ];
}
