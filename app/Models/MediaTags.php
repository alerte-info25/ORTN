<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaTags extends Model
{
    use HasFactory;

    protected $table = 'media_tags';
    
    protected $fillable = [
        'media_id',
        'tags_id' 
    ];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
    
    public function tag()
    {
        return $this->belongsTo(Tags::class, 'tags_id');
    }

}
