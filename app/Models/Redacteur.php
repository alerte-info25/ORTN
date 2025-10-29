<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redacteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'departement_id',
        'matricule',
        'profession',
        'date_embauche',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function programmes ()
    {
        return $this->hasMany(Programme::class);
    }

    public function departement () 
    {
        return $this->belongsTo(Departement::class);
    }

    public function medias ()
    {
        return $this->hasMany(Media::class);
    }

    public function sondages ()
    {
        return $this->hasMany(Sondage::class);
    }

    public function partenaires () 
    {
        return $this->hasMany(Partenaire::class);
    }

    public function publicites ()
    {
        return $this->hasMany(Publicite::class);
    }

    // Un rédacteur peut créer des newsletters
    public function newsletters()
    {
        return $this->hasManyThrough(Newsletter::class, Media::class);
    }
 
}
