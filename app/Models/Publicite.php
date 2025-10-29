<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicite extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_id',
        'partenaire_id',
        'date_debut',
        'date_fin',
    ];

    public function media ()
    {
        return $this->belongsTo(Media::class);
    }

    public function partenaire ()
    {
        return $this->belongsTo(Partenaire::class);
    }

}
