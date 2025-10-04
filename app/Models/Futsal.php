<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Futsal extends Model
{
    use HasFactory;

    protected $table = 'futsals';

    protected $fillable = [
        'name',
        'location',
        'description',
        'phone',
        'price',
        'service',
        'photo',
        'user_id',
    ];

    protected $casts = [
        'service' => 'array',    
        'photo' => 'array',  
        'price' => 'decimal:2',  
    ];

    /**
     * Relationship: futsal belongs to an owner (user with role = owner)
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
