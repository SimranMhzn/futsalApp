<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'futsal_id',
        'user_id',
        'date',
        'start_time',
        'end_time',
        'status',
    ];

    public function futsal()
    {
        return $this->belongsTo(Futsal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
