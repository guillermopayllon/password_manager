<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; // COMENTADO: Desactivamos la verificación de email por ahora
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable; // Importar para 2FA
use Laravel\Sanctum\HasApiTokens; // Importar para API Tokens
use Illuminate\Database\Eloquent\Relations\HasMany; // Importar para la relación HasMany

class User extends Authenticatable // Aquí ya NO implementa MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret', // Ocultar el secreto 2FA
        'two_factor_recovery_codes', // Ocultar los códigos de recuperación 2FA
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

    /**
     * Get the passwords for the user.
     * Un usuario puede tener muchas contraseñas.
     */
    public function passwords(): HasMany
    {
        return $this->hasMany(Password::class);
    }
}
