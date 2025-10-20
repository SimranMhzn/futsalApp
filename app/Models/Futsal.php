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
        'phone',
        'price',
        'location',
        'link',
        'side_no',
        'ground_no',
        'description',
        'photo',
        'user_id',

        'shower_facility',
        'parking_space',
        'changing_room',
        'restaurant',
        'wifi',
        'open_ground',
    ];

    protected $casts = [
        'photo' => 'array',
        'price' => 'decimal:2',

        'shower_facility' => 'boolean',
        'parking_space' => 'boolean',
        'changing_room' => 'boolean',
        'restaurant' => 'boolean',
        'wifi' => 'boolean',
        'open_ground' => 'boolean',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
