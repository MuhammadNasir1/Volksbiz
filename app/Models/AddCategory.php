<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddCategory extends Model
{
    use HasFactory;
    protected $table = 'add_categories';
    public $timestamps = false;

    protected $fillable = [

        'category_image',
        'category_name',
        'category_name_de',
        'status',
    ];
}
