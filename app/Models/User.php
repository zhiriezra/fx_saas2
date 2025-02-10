<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// use Filament\Models\Contracts\FilamentUser; implement this in production

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements HasName, FilamentUser
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

    public function team(){
        return $this->belongsTo(Team::class, 'current_team_id');
    }

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
<<<<<<< Updated upstream
=======

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
>>>>>>> Stashed changes

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->isAdmin();
        }

        if ($panel->getId() === 'agro-input') {
            return $this->isTeam() && $this->team->team_type_id === 1;
        }

        if ($panel->getId() === 'agro-processors') {
            return $this->isTeam() && $this->team->team_type_id === 2;
        }

        return true;
    }

}
