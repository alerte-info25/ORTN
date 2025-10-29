<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartenaireTypePartenariat extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_partenariat_id',
        'partenaire_id',
        'date_debut',
        'date_fin',
        'statut',
    ];

}
