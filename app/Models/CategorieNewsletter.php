<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieNewsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'slug',
    ];

    public function newsletters ()
    {
        return $this->hasMany(Newsletter::class);
    }

}
