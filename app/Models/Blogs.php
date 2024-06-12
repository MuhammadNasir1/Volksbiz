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
        'category',
        'author',
        'image',
        'content',

    ];
    public $timestamp  = true;
}
