<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_id',
        'categorie_video_id',
        'url_video',
        'subtitle'
    ];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function categorieVideo () 
    {
        return $this->belongsTo(CategorieVideo::class);
    }

}
