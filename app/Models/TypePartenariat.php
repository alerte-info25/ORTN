<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePartenariat extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'slug',
        'description',
    ];

    public function partenaires ()
    {
        return $this->belongsToMany(Partenaire::class, 'partenaire_type_partenariats')
                    ->withPivot("date_debut,date_fin,statut")
                    ->withTimestamps();
    }

}
