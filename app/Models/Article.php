<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_id',
        'categorie_article_id',
        'type_article_id',
        'sous_titre',
    ];

    public function media () 
    {
        return $this->belongsTo(Media::class);
    }

    public function categorieArticle ()
    {
        return $this->belongsTo(CategorieArticle::class);
    }

    public function typeArticle ()
    {
        return $this->belongsTo(TypeArticle::class);
    }

    public function commentaires ()
    {
        return $this->hasMany(Commentaire::class);
    }

}
