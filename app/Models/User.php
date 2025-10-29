<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Genre;
use App\Models\Localite;
use App\Models\Redacteur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'genre_id',
        'localite_id',
        'nom',
        'prenom',
        'email',
        'password',
        'role',
        'telephone',
        'actif',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function redacteur()
    {
        return $this->hasOne(Redacteur::class);
    }

    public function localite(): BelongsTo
    {
        return $this->belongsTo(Localite::class);
    }

    public function isRedacteur(): bool
    {
        return $this->hasRole('redacteur');
    }

    public function hasRole($roles): bool
    {
        if (empty($this->role)) return false;

        return is_array($roles)
            ? in_array($this->role, $roles)
            : $this->role === $roles;
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isClient(): bool
    {
        return $this->hasRole('client');
    }


    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function programmes()
    {
        return $this->hasMany(Programme::class);
    }

    public function sondages()
    {
        return $this->belongsToMany(Sondage::class, 'client_sondages')
                    ->withPivot('option_choisie', 'commentaire')
                    ->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function partenaires()
    {
        return $this->hasMany(Partenaire::class);
    }

}
