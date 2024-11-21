<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;

    public $table = "blogs";
    protected $fillable = [
        'title',
        'title_de',
        'category',
        'author',
        'image',
        'content',
        'content_de',

    ];
    public $timestamp  = true;
}
