<?php

namespace App\Models;

use App\Models\TypeContact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_contact_id',
        'user_id',
        'libelle',
    ];

    public function typeContact(): BelongsTo
    {
        return $this->belongsTo(TypeContact::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
