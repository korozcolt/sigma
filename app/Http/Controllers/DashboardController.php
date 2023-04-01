<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voter;
use App\Models\Leader;
use App\Models\Coordinator;
use App\Models\Place;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $voters = Voter::whereType('voter')->get();
        $leaders = Leader::whereType('leader')->get();
        $coordinators = Coordinator::whereType('coordinator')->get();
        $places = Place::all();

        //group model place by place and count the voters
        $places_count = Place::select('place', DB::raw('COUNT(voters.id) as voters_count'))
        ->leftJoin('voters', 'places.id', '=', 'voters.place_id')
        ->groupBy('places.place')
        ->orderBy('voters_count', 'desc')
        ->get();

        return view('dashboard',compact('voters','leaders','coordinators','places','places_count'));
    }
}