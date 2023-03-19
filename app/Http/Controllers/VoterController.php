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
            if ($user->isAdmin()) {
                $voters = Voter::with(['leader', 'place'])->when($search, function ($query) use ($search) {
                    return $query->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhere('dni', 'like', "%$search%");
                })->paginate(10);
            } else {
                $voters = Voter::with(['leader', 'place'])->when($search, function ($query) use ($search) {
                    return $query->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhere('dni', 'like', "%$search%");
                })->where('user_id', '=', $user->id)->paginate(10);
            }

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
        if ($user->isAdmin() || $user->hasRole(['leader', 'coordinator'])) {
            $places = Place::all();
            if ($user->hasRole('coordinator')) {
                $coordinator = Coordinator::with('user')->where($user->id, 'user_id')->first();
                $leaders = Leader::with('coordinator')->where($coordinator->id, 'coordinator_id')->get();
            } else if ($user->hasRole('leader')) {
                $leaders = Leader::with(['coordinator', 'user'])->where($user->id, 'user_id')->get();
            }
            return view('voters.create', compact('places', 'leaders'));
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
    public function status(Voter $voter, VoterRequest $request)
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
        if ($user->isAdmin()) {
            $places = Place::all();
            return view('voters.edit', compact('voter', 'places'));
        } else {
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
}
