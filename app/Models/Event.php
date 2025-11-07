<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title', 
        'description', 
        'category',
        'start_date', 
        'start_time', 
        'end_date', 
        'end_time',
        'format', 
        'venue', 
        'address', 
        'city', 
        'online_url',
        'organizer', 
        'organizer_email', 
        'organizer_phone',
        'image', 
        'capacity', 
        'access_type', 
        'price',
        'requires_registration', 
        'registration_url', 
        'slug',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'event_participant')
                    ->withPivot('status', 'registered_at')
                    ->withTimestamps();
    }

}
