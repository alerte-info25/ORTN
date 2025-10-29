<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLetterAbonne extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'date_abonnement',
        'actif',
    ];

}
