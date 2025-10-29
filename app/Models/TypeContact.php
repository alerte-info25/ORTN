<?php

namespace App\Models;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
    ];

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

}
