<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_id',
        'categorie_audio_id',
        'url_audio',
        'subtitle'
    ];

    public function media ()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function categorieAudio () 
    {
        return $this->belongsTo(CategorieAudio::class);
    }

}
