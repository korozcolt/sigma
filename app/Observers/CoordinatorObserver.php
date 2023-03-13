<?php

namespace App\Observers;

use App\Helpers\Helper;
use App\Models\Coordinator;

class CoordinatorObserver
{
    /**
     * Handle the Coordinator "created" event.
     *
     * @param  \App\Models\Coordinator  $coordinator
     * @return void
     */
    public function created(Coordinator $coordinator)
    {
        $email = $coordinator->dni . '@' . 'sigmaapp.co';
        $password = $coordinator->dni . '2023';

        $message = 'Bienvenido a Sigma, tu usuario es: ' . $email . ' y tu contraseña es: ' . $password;

        Helper::sendSms($coordinator, $message);
    }

    /**
     * Handle the Coordinator "updated" event.
     *
     * @param  \App\Models\Coordinator  $coordinator
     * @return void
     */
    public function updated(Coordinator $coordinator)
    {
        //
    }

    /**
     * Handle the Coordinator "deleted" event.
     *
     * @param  \App\Models\Coordinator  $coordinator
     * @return void
     */
    public function deleted(Coordinator $coordinator)
    {
        //
    }

    /**
     * Handle the Coordinator "restored" event.
     *
     * @param  \App\Models\Coordinator  $coordinator
     * @return void
     */
    public function restored(Coordinator $coordinator)
    {
        //
    }

    /**
     * Handle the Coordinator "force deleted" event.
     *
     * @param  \App\Models\Coordinator  $coordinator
     * @return void
     */
    public function forceDeleted(Coordinator $coordinator)
    {
        //
    }
}
