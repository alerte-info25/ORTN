<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sondage extends Model
{
    use HasFactory;

    protected $fillable = [
        'redacteur_id',
        'titre',
        'description',
        'option1',
        'option2',
        'option3',
        'option4',
        'option5',
        'date_debut',
        'date_fin',
        'actif',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'client_sondages')
                    ->withPivot('option_choisie', 'commentaire')
                    ->withTimestamps();
    }

    public function redacteur ()
    {
        return $this->belongsTo(Redacteur::class);
    }

}
