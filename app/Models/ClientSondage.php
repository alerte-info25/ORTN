<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientSondage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sondage_id',
        'option_choisie',
        'commentaire',
    ];

}
