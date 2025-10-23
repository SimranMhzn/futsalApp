<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Futsal extends Authenticatable
{
    use HasFactory, Notifiable; 

    protected $table = 'futsals';

    protected $fillable = [
        'name',
        'phone',
        'price',
        'email',
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
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token', 
    ];

    protected $casts = [
        'shower_facility' => 'boolean',
        'parking_space'   => 'boolean',
        'changing_room'   => 'boolean',
        'restaurant'      => 'boolean',
        'wifi'            => 'boolean',
        'open_ground'     => 'boolean',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPhotoUrlAttribute(): string
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : asset('images/default-futsal.jpg');
    }
}
