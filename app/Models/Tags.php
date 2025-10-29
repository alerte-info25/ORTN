<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'libelle',
        'slug',
    ];

    public function medias ()
    {
        return $this->belongsToMany(Media::class, 'media_tags')->withTimestamps();
    }

}
