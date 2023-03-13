<?php

namespace App\Observers;

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

        $this->smsSend($coordinator, $message);
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

    private function smsSend($coordinator, $message)
    {
        $account = env('SMS_ACCOUNT');
        $apiKey = env('SMS_API_KEY');
        $token = env('SMS_API_SECRET');
        $baseUrl = env('SMS_API_URL_BASE');
        $request = [
            'toNumber' => '57' . $coordinator['phone'],
            'sms' => $message,
            'flash' => '0',
            'sendDate' => time(),
            'sc' => '890202',
            'request_dlvr_rcpt' => '0',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $baseUrl . '/marketing');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Account: ' . $account,
            'ApiKey: ' . $apiKey,
            'Token: ' . $token,
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }

        curl_close($ch);
    }
}
