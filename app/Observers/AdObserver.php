<?php

namespace App\Observers;

use App\Events\AdCreated;
use App\Models\Ad;

class AdObserver
{
    /**
     * Handle the Ad "created" event.
     *
     * @param  \App\Models\Ad  $ad
     * @return void
     */
    public function created(Ad $ad)
    {
        // event(new AdCreated($ad));
        AdCreated::dispatch($ad);
    }

    /**
     * Handle the Ad "updated" event.
     *
     * @param  \App\Models\Ad  $ad
     * @return void
     */
    public function updated(Ad $ad)
    {
        //
    }

    /**
     * Handle the Ad "deleted" event.
     *
     * @param  \App\Models\Ad  $ad
     * @return void
     */
    public function deleted(Ad $ad)
    {
        $ad->media()->delete();
    }

    /**
     * Handle the Ad "restored" event.
     *
     * @param  \App\Models\Ad  $ad
     * @return void
     */
    public function restored(Ad $ad)
    {
        //
    }

    /**
     * Handle the Ad "force deleted" event.
     *
     * @param  \App\Models\Ad  $ad
     * @return void
     */
    public function forceDeleted(Ad $ad)
    {
        //
    }
}
