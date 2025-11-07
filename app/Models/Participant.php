<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'nom', 
        'prenom', 
        'email', 
        'telephone', 
        'organisation'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_participant')
                    ->withPivot('status', 'registered_at')
                    ->withTimestamps();
    }

    public function payments ()
    {
        return $this->hasMany(Payment::class);
    }
}
