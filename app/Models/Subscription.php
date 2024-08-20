<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $table = 'subscriptions';
    protected $timestamp = true;
    protected $fillable = [
        'name',
        'price',
        'option',
        'plan_for',
    ];
}
