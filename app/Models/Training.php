<?php

namespace App\Models;

use App\Observers\TrainingObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[ObservedBy([TrainingObserver::class])]
class Training extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });

    }

    protected static function booted(): void
    {
        // static::addGlobalScope('team', function (Builder $query) {
        //     if (auth()->user()->isTeam()) {
        //         $query->where('team_id', auth()->user()->current_team_id);
        //         // or with a `team` relationship defined:
        //         // $query->whereBelongsTo(auth()->user()->team);
        //     }
        // });
    }

    protected $fillable = [
        'agent_id',
        'state_id',
        'lga_id',
        'title',
        'description',
        'venue',
        'number_of_participants',
        'start_date',
        'end_date',
        'status',
        'females',
        'males',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }
}
