<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dons extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'nationalite',
        'pays',
        'ville',
        'adresse',
        'code_postal',
        'montant',
        'methode_paiement',
        'transaction_id',
        'cinetpay_transaction_id',
        'payment_token',
        'statut',
        'notify_url',
        'return_url',
        'date_heure_don',
    ];

}
