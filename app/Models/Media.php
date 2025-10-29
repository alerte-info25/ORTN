<?php

namespace App\Models;

use App\Models\Tags;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'redacteur_id',
        'titre',
        'slug',
        'description',
        'image',
        'media_tags',  // Nom de la table pivot
        'media_id',    // Clé étrangère du modèle actuel
        'tags_id'
    ];

    public function redacteur ()
    {
        return $this->belongsTo(Redacteur::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'media_tags', 'media_id', 'tags_id');
    }

    public function video(): HasOne
    {
        return $this->hasOne(Video::class);
    }

    public function audio(): HasOne
    {
        return $this->hasOne(Audio::class);
    }

    public function article(): HasOne
    {
        return $this->hasOne(Article::class);
    }

    public function newsletter(): HasOne
    {
        return $this->hasOne(Newsletter::class);
    }

    public function publicite () : HasOne
    {
        return $this->hasOne(Publicite::class);
    }

}
