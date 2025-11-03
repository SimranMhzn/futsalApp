<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'location',
        'author',
        'date_created',
    ];

    protected $dates = ['date_created'];
    protected static function booted()
    {
        static::creating(function ($blog) {
            $blog->date_created = now(); 
        });
    }
}
