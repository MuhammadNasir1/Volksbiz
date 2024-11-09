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

        'image',
        'name_en',
        'name_de',
        'status',
    ];
}
