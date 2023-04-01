<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sms.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contacts = [];
        $message = $request->message;

        if($request->option_send == '1'){
            $contacts = \App\Models\Coordinator::all();
        }else if($request->option_send == '2'){
            $contacts = \App\Models\Leader::all();
        }else if($request->option_send == '3'){
            $contacts = \App\Models\Voter::where('type', 'voter')->get();
        }else if($request->option_send == '0'){
            $contacts = \App\Models\Coordinator::all();
            $contacts = $contacts->merge(\App\Models\Leader::all());
            $contacts = $contacts->merge(\App\Models\Voter::where('type', 'voter')->get());
        }
        
        $count = count($contacts);

        $response = \App\Helpers\Helper::sendSmsBulk($contacts, $message);

        return redirect()->route('sms.index')->with('success', 'Se han enviado ' . $count . ' mensajes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function link(Request $request)
    {
        //validate the url to create a short link
        $request->validate([
            'url' => 'required|url'
        ]);
        $url = $request->url;
        $response = \App\Helpers\Helper::shortLink($url);

        return $response;
    }
}