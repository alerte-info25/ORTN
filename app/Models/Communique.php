<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Communique extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'subtitle',
        'content',
        'images',
        'views_count',
    ];

    protected $casts = [
        'views_count' => 'integer',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtenir un extrait du contenu
     */
    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->content), 150);
    }

}
