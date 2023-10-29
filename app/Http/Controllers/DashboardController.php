<?php

namespace App\Http\Controllers;

use App\Models\Votation;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $votationsOpinion = Votation::where('type', 'opinion')->count();
        $votationsYes = Votation::where('type', 'yes')->count();$votationCounts = Votation::select(
        'nombre_puesto',
        DB::raw('SUM(CASE WHEN type = "opinion" THEN 1 ELSE 0 END) as TOTAL_OPINION'),
        DB::raw('SUM(CASE WHEN type = "yes" THEN 1 ELSE 0 END) as TOTAL_YES')
    )
        ->groupBy('nombre_puesto')
        ->get();

        return view('dashboard', compact('votationCounts', 'votationsOpinion', 'votationsYes'));
    }

    public function realTime(){
        $votationsOpinion = Votation::where('type', 'opinion')->count();
        $votationsYes = Votation::where('type', 'yes')->count();
        $votationCounts = Votation::select(
            'nombre_puesto',
            DB::raw('SUM(CASE WHEN type = "opinion" THEN 1 ELSE 0 END) as TOTAL_OPINION'),
            DB::raw('SUM(CASE WHEN type = "yes" THEN 1 ELSE 0 END) as TOTAL_YES')
        )
            ->groupBy('nombre_puesto')
            ->get();
        return response()->json(['votationCounts' => $votationCounts, 'votationsOpinion' => $votationsOpinion, 'votationsYes' => $votationsYes]);
    }
}
