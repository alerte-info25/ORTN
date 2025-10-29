<?php

namespace App\Models;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        "media_id",
        "categorie_newsletter_id"	
    ];

    public function media (): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function categorieNewsletter ()
    {
        return $this->belongsTo(CategorieNewsletter::class);
    }

}
