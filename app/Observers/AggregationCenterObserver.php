<?php

namespace App\Observers;

use App\Models\AggregationCenter;

class AggregationCenterObserver
{
    /**
     * Handle the AggregationCenter "created" event.
     */
    public function created(AggregationCenter $aggregationCenter): void
    {
        if(auth()->user()){
            $aggregationCenter->team_id = auth()->user()->team_id;
            $aggregationCenter->save();
        }
    }

    /**
     * Handle the AggregationCenter "updated" event.
     */
    public function updated(AggregationCenter $aggregationCenter): void
    {
        //
    }

    /**
     * Handle the AggregationCenter "deleted" event.
     */
    public function deleted(AggregationCenter $aggregationCenter): void
    {
        //
    }

    /**
     * Handle the AggregationCenter "restored" event.
     */
    public function restored(AggregationCenter $aggregationCenter): void
    {
        //
    }

    /**
     * Handle the AggregationCenter "force deleted" event.
     */
    public function forceDeleted(AggregationCenter $aggregationCenter): void
    {
        //
    }
}
