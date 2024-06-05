<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddBusiness extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected  $fillable = [
        'bus_img1',
        'bus_img2',
        'bus_img3',
        'bus_img4',
        'bus_video',
        'bus_category',
        'bus_title',
        'bus_country',
        'bus_city',
        'bus_description',
        'bus_price',
    ];
}
