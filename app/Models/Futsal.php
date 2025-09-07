<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class futsal extends Model
{
    use HasFactory;
    protected $table = 'futsals';

    protected $fillable = [
        'futsal', 
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}