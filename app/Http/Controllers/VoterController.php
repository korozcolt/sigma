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
            $query = Voter::with(['leader', 'place']);

            if ($user->hasRole('leader')) {
                // Filtrar votantes del líder logueado
                $query->where('leader_id', $user->id);
            } elseif ($user->hasRole('coordinator')) {
                // Obtener líderes relacionados con el coordinador logueado
                $leaderIds = $user->coordinator->leaders()->pluck('id')->toArray();

                // Filtrar votantes de los líderes relacionados con el coordinador
                $query->whereIn('leader_id', $leaderIds);
            }

            $voters = $query->when($search, function ($query) use ($search) {
                return $query->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('dni', 'like', "%$search%");
            })->paginate(10);

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
        // Only admins, coordinators and leaders can see voters
        // Admins can see all voters
        // Coordinators can see voters of their leaders
        // Leaders can see voters of their own
        $user = Auth::user();
        if($user->hasRole(['coordinator', 'leader']) || $user->isAdmin()) {
            $places = Place::all();
            $leaders = Leader::all();

            if ($user->hasRole('coordinator')) {
                $leaders = $user->coordinator->leaders;
            } elseif ($user->hasRole('leader')) {
                $leaders = $user->leader->where('id', $user->id);
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