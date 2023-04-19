<?php

namespace App\Observers;

use App\Helpers\Helper;
use App\Models\Leader;

class LeaderObserver
{
    /**
     * Handle the Leader "created" event.
     *
     * @param  \App\Models\Leader  $leader
     * @return void
     */
    public function created(Leader $leader)
    {
        Helper::sendSms($leader, Helper::createMessage($leader));
    }

    /**
     * Handle the Leader "updated" event.
     *
     * @param  \App\Models\Leader  $leader
     * @return void
     */
    public function updated(Leader $leader)
    {
        //
    }

    /**
     * Handle the Leader "deleted" event.
     *
     * @param  \App\Models\Leader  $leader
     * @return void
     */
    public function deleted(Leader $leader)
    {
        //
    }

    /**
     * Handle the Leader "restored" event.
     *
     * @param  \App\Models\Leader  $leader
     * @return void
     */
    public function restored(Leader $leader)
    {
        //
    }

    /**
     * Handle the Leader "force deleted" event.
     *
     * @param  \App\Models\Leader  $leader
     * @return void
     */
    public function forceDeleted(Leader $leader)
    {
        //
    }
}
