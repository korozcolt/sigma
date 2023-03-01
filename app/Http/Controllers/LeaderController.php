<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaderRequest;
use App\Models\Leader;
use App\Models\Coordinator;
use App\Models\Place;
use App\Models\User;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class LeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole('coordinator') || $user->isAdmin() || $user->hasRole('leader')) {
            $search = $request->input('search');
            $leaders = Leader::when($search, function ($query) use ($search) {
                return $query->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('dni', 'like', "%$search%");
            })->paginate(10);

            if (session('success_message')) {
                Alert::success('Éxito', session('success_message'));
            }

            return view('leaders.index', compact('leaders', 'search'));
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
        if ($user->isAdmin()) {
            $places = Place::all();
            $coordinators = Coordinator::all();
            return view('leaders.create', compact('places', 'coordinators'));
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
    public function store(LeaderRequest $request)
    {
        $leader = Leader::create($request->validated());

        // Crear y asociar usuario
        $email = $leader->dni . '@' . 'sigma.com';
        $password = $leader->dni . '2023';
        $name = $leader->full_name;
        $user = User::create([
            'email' => $email,
            'name' => $name,
            'password' => Hash::make($password),
            'role' => 'leader',
        ]);
        $leader->user()->associate($user);
        $leader->save();

        return redirect()->route('leaders.index')->with('success', 'Líder creado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function edit(Leader $leader)
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $places = Place::all();
            return view('leaders.edit', compact('leader', 'places'));
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function update(LeaderRequest $request, Leader $leader)
    {
        $leader->update($request->validated());
        return redirect()->route('leaders.index')->with('success', 'Líder actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Leader $leader
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leader $leader)
    {
        $user = $leader->user;
        if ($user) {
            $user->delete();
        }
        $voterIds = $leader->voters->pluck('id');
        $leader1 = Leader::find(1);
        $leader1->voters()->whereIn('id', $voterIds)->update(['leader_id' => $leader1->id]);

        // Delete the leader
        $leader->delete();
        return redirect()->route('leaders.index')->with('success', 'Líder eliminado correctamente.');
    }
}
