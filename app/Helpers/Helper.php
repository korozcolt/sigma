<?php

namespace App\Helpers;

class Helper
{
    public static function sendSmsBulk($contacts, $message)
    {
        $account = env('SMS_ACCOUNT');
        $apiKey = env('SMS_API_KEY');
        $token = env('SMS_API_SECRET');
        $baseUrl = env('SMS_API_URL_BASE');

        $messages = [];

        foreach ($contacts as $contact) {
            $messages[] = [
                'numero' => '57' . $contact->phone,
                'sms' => $message,
            ];
        }

        $request = [
            'flash' => '0',
            'sendDate' => time(),
            'sc' => '890202',
            'request_dlvr_rcpt' => '0',
            'bulk' => $messages,
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $baseUrl . '/marketing/bulk');
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

        if (isset($error_msg)) {
            return ['success' => false, 'message' => $error_msg];
        } else {
            return ['success' => true, 'message' => $response];
        }
    }

    public static function sendSms($contact, $message)
    {
        $account = env('SMS_ACCOUNT');
        $apiKey = env('SMS_API_KEY');
        $token = env('SMS_API_SECRET');
        $baseUrl = env('SMS_API_URL_BASE');
        $request = [
            'toNumber' => '57' . $contact['phone'],
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
        return $response;
    }
}
