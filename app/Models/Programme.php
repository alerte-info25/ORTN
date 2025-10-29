<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_programme_id',
        'redacteur_id',
        'nom',
        'description',
        'slug',
        'animateur',
        'jour_diffusion',
        'heure_debut1',
        'heure_fin1',
        'heure_debut2',
        'heure_fin2',
        'heure_debut3',
        'heure_fin3',
        'heure_debut4',
        'heure_fin4',
    ];

    public function redacteur () 
    {
        return $this->belongsTo(Redacteur::class);
    }

    public function typeProgramme ()
    {
        return $this->belongsTo(TypeProgramme::class);
    }
}
