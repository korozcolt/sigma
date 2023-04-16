<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoterRequest;
use App\Models\Coordinator;
use App\Models\Leader;
use App\Models\Place;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Enums\EntityParent;

class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole(['coordinator', 'leader']) || $user->isAdmin()) {
            $search = $request->input('search');
            $query = Voter::with('leader','place')->whereType('voter')->with('leader.coordinator');

            if ($user->hasRole('leader')) {
                $query->where('leader_id', $user->id);
            } elseif ($user->hasRole('coordinator')) {
                $leaderIds = $user->coordinator->leaders()->pluck('id')->toArray();
                $query->whereIn('leader_id', $leaderIds);
            }

            $voters = $query->when($search, function ($query) use ($search) {
                return $query->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('dni', 'like', "%$search%");
            })->orderBy('leader_id','asc')->paginate(10);

            if (session('success_message')) {
                Alert::success('Éxito', session('success_message'));
            }

            return view('voters.index', compact('voters', 'search'));
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if($user->hasRole(['coordinator', 'leader']) || $user->isAdmin()) {
            $places = Place::all();
            $leaders = Leader::all();
            $entityParents = EntityParent::getValues();

            if ($user->hasRole('coordinator')) {
                $leaders = $user->coordinator->leaders;
            } elseif ($user->hasRole('leader')) {
                $leaders = $user->leader->where('id', $user->id);
            }
            return view('voters.create', compact('places', 'leaders', 'entityParents'));
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoterRequest $request)
    {
        $voter = Voter::create($request->validated());

        $voter->status = 'pendiente';
        $voter->type = 'voter';
        $voter->candidate = 'none';
        $voter->debate_boss = 'none';
        $voter->save();

        return redirect()->route('voters.index')->with('success', 'Votante creado correctamente.');
    }

    /**
     * status
     *
     * @param  mixed $voter
     * @param  mixed $request
     * @return void
     */
    public function status(Voter $voter, Request $request)
    {
        $voter->status = $request->status;
        $voter->save();

        return redirect()->route('voters.index')->with('success', 'Votante actualizado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function edit(Voter $voter)
    {
        $user = Auth::user();
        if($user->hasRole(['coordinator', 'leader']) || $user->isAdmin()) {
            $places = Place::all();
            $leaders = Leader::all();
            $entityParents = EntityParent::getValues();

            if ($user->hasRole('coordinator')) {
                $leaders = $user->coordinator->leaders;
            } elseif ($user->hasRole('leader')) {
                $leaders = $user->leader->where('id', $user->id);
            }
            return view('voters.edit', compact('places', 'leaders', 'voter', 'entityParents'));
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function update(VoterRequest $request, Voter $voter)
    {
        $voter->update($request->validated());
        return redirect()->route('voters.index')->with('success', 'Votante actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voter $voter)
    {
        $voter->delete();
        return redirect()->route('voters.index')->with('success', 'Votante eliminado correctamente.');
    }

    //Public function without auth
    //function to show a view with public_url_token and leader_id setting
    public function new_voter($public_url_string){
        $leader = Leader::where('public_url_string', $public_url_string)->first();
        $leader_id = $leader->id;

        return view('voters.public.create', compact('leader_id', 'public_url_string'));
    }
}
