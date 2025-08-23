<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Importar para la relación BelongsTo

class Password extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', // Asegúrate de incluir user_id aquí
        'name',
        'encrypted_password',
        'url',
        'two_factor_secret',
        'notes',
        'attachments',
    ];

    /**
     * Get the user that owns the password.
     * Una contraseña pertenece a un único usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
