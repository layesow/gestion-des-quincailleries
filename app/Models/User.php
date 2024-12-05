<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Vente;
use App\Models\Caisse;
use App\Models\Client;
use App\Models\Quincaillerie;
use Illuminate\Support\Facades\URL;
//use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
//use App\Mail\CustomVerifyEmail;
use Laratrust\Traits\LaratrustUserTrait;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'statut',
        'quincaillerie_id',
        'password',
        'caisse_id',
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
        'password' => 'hashed',
    ];

    protected $defaultRoles = ['client', 'agence'];

    /* public function sendEmailVerificationNotification()
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $this->id, 'hash' => sha1($this->email)]
        );

        Mail::to($this->email)->send(new CustomVerifyEmail($verificationUrl));

    } */

    /* public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    } */

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // Pour savoir si un utilisateur est dans un rôle en particulier

    public function quincaillerie()
    {
        //return $this->belongsTo(Agence::class);
        return $this->belongsTo(Quincaillerie::class);
    }

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    public function caisse()
{
    return $this->belongsTo(Caisse::class);
}


}
