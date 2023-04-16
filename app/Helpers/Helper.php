<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Crypt;

class Helper
{
    // TODO: declare global constants with account, apiKey, token and baseUrl. Use env() to get the values from .env file
    protected static $account = '';
    protected static $apiKey = '' ;
    protected static $token     = '';
    protected static $baseUrl  = '';

    public static function initialize(){

        self::$account = env('SMS_ACCOUNT');
        self::$apiKey = env('SMS_API_KEY');
        self::$token = env('SMS_API_SECRET');
        self::$baseUrl = env('SMS_API_URL_BASE');
    }

    public static function sendSmsBulk($contacts, $message)
    {
        self::initialize();
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

        curl_setopt($ch, CURLOPT_URL, self::$baseUrl . '/sms/v3/send/marketing/bulk');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Account: ' . self::$account,
            'ApiKey: ' . self::$apiKey,
            'Token: ' . self::$token,
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
        self::initialize();
        $request = [
            'toNumber' => '57' . $contact['phone'],
            'sms' => $message,
            'flash' => '0',
            'sendDate' => time(),
            'sc' => '890202',
            'request_dlvr_rcpt' => '0',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, self::$baseUrl . '/sms/v3/send/marketing');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Account: ' . self::$account,
            'ApiKey: ' . self::$apiKey,
            'Token: ' . self::$token,
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }

        curl_close($ch);
        return $response;
    }

    public static function shortLink($link){

        self::initialize();
        $request = [
            'url' => $link,
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, self::$baseUrl . '/url-shortener/v1/token');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Account: ' . self::$account,
            'ApiKey: ' . self::$apiKey,
            'Token: ' . self::$token,
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }

        curl_close($ch);
        return $response;
    }
}