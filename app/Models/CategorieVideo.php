<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'slug',
    ];

    public function videos ()
    {
        return $this->hasMany(Video::class);
    }

}
