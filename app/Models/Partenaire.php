<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'email',
        'contact',
        'site_web',
        'reseaux',
        'adresse',
        'secteur_activite',
        'logo',
        'type_partenariat',
        'date_debut',
        'date_fin',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function typePartenariats ()
    {
        return $this->belongsToMany(TypePartenariat::class, 'partenaire_type_partenariats')
                    ->withPivot("date_debut,date_fin,statut")
                    ->withTimestamps();
    }

    public function publicites ()
    {
        return $this->hasMany(Publicite::class);
    }

}
