<?php

namespace App\Http\Controllers;

use App\Models\Coordinator;
use App\Http\Requests\CoordinatorRequest;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class CoordinatorController extends Controller
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
            $coordinators = Coordinator::when($search, function ($query) use ($search) {
                return $query->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('dni', 'like', "%$search%");
            })->paginate(10);

            if (session('success_message'))
                Alert::success('Éxito', session('success_message'));

            return view('coordinators.index', compact('coordinators', 'search'));
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
        if ($user->hasRole('coordinator') || $user->isAdmin()) {
            $places = Place::all();
            return view('coordinators.create', compact('places'));
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CoordinatorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoordinatorRequest $request)
    {
        $coordinator = Coordinator::create($request->validated());

        $email = $coordinator->dni . '@' . 'sigma.com';
        $password = $coordinator->dni . '2023';
        $name = $coordinator->full_name;
        $user = User::create([
            'email' => $email,
            'name' => $name,
            'password' => Hash::make($password),
            'role' => 'coordinator',
        ]);
        //$coordinator->user()->associate($user);
        $coordinator->save();

        return redirect()->route('coordinators.index')->with('success', 'Coordinador creado Correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coordinator  $coordinator
     * @return \Illuminate\Http\Response
     */
    public function edit(Coordinator $coordinator)
    {
        $user = Auth::user();
        if ($user->hasRole('coordinator') || $user->isAdmin()) {
            $places = Place::all();
            return view('coordinators.edit', compact('coordinator', 'places'));
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CoordinatorRequest  $request
     * @param  \App\Models\Coordinator  $coordinator
     * @return \Illuminate\Http\Response
     */
    public function update(CoordinatorRequest $request, Coordinator $coordinator)
    {
        $coordinator->update($request->validated());
        return redirect()->route('coordinators.index')->with('success', 'Coordinador actualizado Correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coordinator  $coordinator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coordinator $coordinator)
    {
        $user = $coordinator->user;
        if ($user) {
            $user->delete();
        }

        // Mover los Leader asociados a otro Coordinator
        $leaderIds = $coordinator->leaders->pluck('id');
        $otherCoordinator = Coordinator::find(1);
        $otherCoordinator->leaders()->whereIn('id', $leaderIds)->update(['coordinator_id' => $otherCoordinator->id]);

        // Eliminar el Coordinator
        $coordinator->delete();
        return redirect()->route('coordinators.index')->with('success', 'Coordinator Eliminado Correctamente');
    }
}
