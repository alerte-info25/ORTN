<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieAudio extends Model
{
    use HasFactory;

    protected $table = 'categorie_audios';

    protected $fillable = [
        'libelle',
        'slug',
    ];

    public function audios ()
    {
        return $this->hasMany(Audio::class);
    }

}
