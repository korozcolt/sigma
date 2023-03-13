<?php

namespace App\Observers;

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
        $email = $leader->dni . '@' . 'sigmaapp.co';
        $password = $leader->dni . '2023';

        $message = 'Bienvenido a Sigma, tu usuario es: ' . $email . ' y tu contraseña es: ' . $password;

        $this->smsSend($leader, $message);
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
