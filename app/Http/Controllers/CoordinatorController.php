<?php

namespace App\Http\Controllers;

use App\Models\Coordinator;
use App\Http\Requests\CoordinatorRequest;
use App\Models\Leader;
use App\Models\Place;
use App\Models\User;
use App\Models\Voter;
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
        if ($user->hasRole(['coordinator', 'leader']) || $user->isAdmin()) {
            $search = $request->input('search');
            if ($user->isAdmin()) {
                $coordinators = Coordinator::with(['users', 'place', 'leaders'])->when($search, function ($query) use ($search) {
                    return $query->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhere('dni', 'like', "%$search%");
                })->paginate(10);
            } else {
                $coordinators = Coordinator::with(['users', 'place', 'leaders'])->when($search, function ($query) use ($search) {
                    return $query->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhere('dni', 'like', "%$search%");
                })->where('user_id', '=', $user->id)->paginate(10);
            }

            if (session('success_message'))
                Alert::success('Éxito', session('success_message'));

            return view('coordinators.index', compact('coordinators', 'search'));
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    //voters list for coordinators order by leaders
    //the function receives the id of the coordinator
    //only send response if the user is a coordinator or isAdmin
    //this function return a view with the list of voters
    //remember coordinators has a relation with leaders and leaders has a relation with voters
    public function list(Coordinator $coordinator)
    {
        $user = Auth::user();
        if ($user->hasRole('coordinator') || $user->isAdmin()) {
            $leaders = Leader::where('coordinator_id', $coordinator->id)->get();
            $voters = [];
            foreach ($leaders as $leader) {
                $voters = $voters->merge(Voter::where('leader_id', $leader->id)->get());
            }
            return view('coordinators.list', compact('voters'));
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

        $email = $request->dni . '@' . 'sigmaapp.co';
        $password = $request->dni . '2023';
        $name = $request->first_name . ' ' . $request->last_name;

        $user = User::create([
            'email' => $email,
            'name' => $name,
            'password' => Hash::make($password),
            'role' => 'coordinator',
        ]);

        $coordinator->user_id = $user->id;
        $coordinator->status = 'pendiente';
        $coordinator->type = 'coordinator';
        $coordinator->candidate = 'none';
        $coordinator->debate_boss = 'none';
        $coordinator->save();

        //create leader and voter too with the same information of coordinator
        $leader = Leader::create([
            'first_name' => $coordinator->first_name,
            'last_name' => $coordinator->last_name,
            'dni' => $coordinator->dni,
            'phone' => $coordinator->phone,
            'place_id' => $coordinator->place_id,
            'user_id' => $user->id,
            'coordinator_id' => $coordinator->id,
            'address' => 'none',
            'type' => 'coordinator',
            'candidate' => 'none',
            'status' => 'pendiente',
            'debate_boss' => 'none'
        ]);

        Voter::create([
            'first_name' => $coordinator->first_name,
            'last_name' => $coordinator->last_name,
            'dni' => $coordinator->dni,
            'phone' => $coordinator->phone,
            'place_id' => $coordinator->place_id,
            'user_id' => $user->id,
            'leader_id' => $leader->id,
            'address' => 'none',
            'type' => 'coordinator',
            'candidate' => 'none',
            'status' => 'pendiente',
            'debate_boss' => 'none'
        ]);

        return redirect()->route('coordinators.index')->with('success', 'Coordinador creado Correctamente.');
    }

    /**
     * status
     *
     * @param  mixed $coordinator
     * @param  mixed $request
     * @return void
     */
    public function status(Coordinator $coordinator, Request $request)
    {
        $coordinator->status = $request->status;
        $coordinator->save();

        return redirect()->route('coordinators.index')->with('success', 'Coordinador actualizado correctamente.');
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
        $user = User::whereId($coordinator->user_id)->first();
        if ($user) {
            $user->delete();
        }
        // Mover los Leader asociados a otro Coordinator
        $leaderIds = $coordinator->leaders->pluck('id');
        if ($leaderIds->count() > 0) {
            $otherCoordinator = Coordinator::whereDni('1102812122')->first();
            $otherCoordinator->leaders()->whereIn('id', $leaderIds)->update(['coordinator_id' => $otherCoordinator->id]);
        }

        // Eliminar el Coordinator
        $coordinator->delete();
        return redirect()->route('coordinators.index')->with('success', 'Coordinator Eliminado Correctamente');
    }
}
