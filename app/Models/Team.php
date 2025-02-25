<?php

namespace App\Models;

use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model implements HasAvatar
{
    use HasFactory;

    protected $guarded = [''];

    public function getLogoUrl(): string
    {
        return $this->logo;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->logo;
    }

    public function agents(): HasMany{
        return $this->hasMany(Agent::class);
    }

    public function competitionActivities(): HasMany{
        return $this->hasMany(CompetitionActivity::class);
    }

    public function team_type(): BelongsTo
    {
        return $this->belongsTo(TeamType::class);
    }



}
