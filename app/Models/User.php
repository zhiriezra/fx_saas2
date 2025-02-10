<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// use Filament\Models\Contracts\FilamentUser; implement this in production

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements HasName, HasTenants
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
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


    public function isAdmin(){
        return $this->user_type_id === 3;
    }

    public function isTeam(): bool
    {
        return $this->user_type_id === 4;
    }

    public function isAgroInput(): bool
    {
        dd($this->team);
    }

    public function getFilamentName(): string
    {
        return "{$this->firstname} {$this->lastname}";
    }
<<<<<<< HEAD
<<<<<<< Updated upstream
=======

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
>>>>>>> Stashed changes

    public function canAccessPanel(Panel $panel): bool
=======
    
    public function teams(): BelongsToMany
>>>>>>> c5aa88c115319032d22afa9c48ac23ad4ccc1e8b
    {
        return $this->belongsToMany(Team::class);
    }

    public function getTenants(Panel $panel): Collection
    {
        return $this->teams;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->teams()->whereKey($tenant)->exists();
    }


}
