<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;


#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password'])]
class User extends Authenticatable
{
    // /** @use HasFactory<UserFactory> */
    // use HasFactory, Notifiable;
 
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function bebans(): HasMany
    {
        return $this->hasMany(Beban::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }
}
