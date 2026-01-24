<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TeamType extends Model
{
    use HasFactory;

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    /**
     * Get the services for the team type.
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
