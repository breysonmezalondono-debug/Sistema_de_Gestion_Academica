<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => 'string',
        ];
    }

    public function sendPasswordResetNotification($token): void
    {
        $url = route('password.reset', $token) . '?email=' . urlencode($this->email);

        $this->notify(new \Illuminate\Auth\Notifications\ResetPassword($token));
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'user_id');
    }

    public function profesor()
    {
        return $this->hasOne(Profesor::class, 'user_id');
    }

    public function esAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function esProfesor(): bool
    {
        return $this->role === 'profesor';
    }

    public function esEstudiante(): bool
    {
        return $this->role === 'estudiante';
    }
}
