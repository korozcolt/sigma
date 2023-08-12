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
        //the search variable is the value of the input search
        //all queries must be order by coordinator_id asc
        $search = $request->input('search');
        $user = Auth::user();
        if ($user->hasRole(['coordinator', 'leader','digitizer']) || $user->isAdmin()) {
            if ($user->isAdmin() || $user->isDigitizer()) {
                $leaders = Leader::with(['place', 'coordinator', 'user', 'voters'])->when($search, function ($query) use ($search) {
                    return $query->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhere('dni', 'like', "%$search%");
                    })->orderBy('coordinator_id', 'asc')->whereType('leader')->paginate(10);
                return view('leaders.index', compact('leaders'));
            } else {
                if ($user->hasRole(['coordinator'])) {
                    $coordinator = Coordinator::with(['place', 'users'])->where('user_id', $user->id)->first();
                    $leaders = Leader::with(['place', 'coordinator', 'user', 'voters'])->when($search, function ($query) use ($search) {
                        return $query->where('first_name', 'like', "%$search%")
                            ->orWhere('last_name', 'like', "%$search%")
                            ->orWhere('dni', 'like', "%$search%");
                        })->whereType('leader')->where('coordinator_id', $coordinator->id)->orderBy('coordinator_id', 'asc')->paginate(10);
                    return view('leaders.index', compact('leaders'));
                } else {
                    $leaders = Leader::with(['place', 'coordinator', 'user', 'voters'])->when($search, function ($query) use ($search) {
                        return $query->where('first_name', 'like', "%$search%")
                            ->orWhere('last_name', 'like', "%$search%")
                            ->orWhere('dni', 'like', "%$search%");
                        })->whereType('leader')->where('user_id', $user->id)->orderBy('coordinator_id', 'asc')->paginate(10);
                    return view('leaders.index', compact('leaders'));
                }
            }
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
        if ($user->hasRole(['coordinator','digitizer']) || $user->isAdmin()) {
            if ($user->isAdmin()) {
                $places = Place::all();
                $coordinators = Coordinator::all();
                return view('leaders.create', compact('places', 'coordinators'));
            } else {
                $places = Place::all();
                $coordinators = Coordinator::with(['place', 'users'])->where('user_id', $user->id)->get();
                return view('leaders.create', compact('places', 'coordinators'));
            }
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
        $email = $request->dni . '@' . 'sigmaapp.co';
        $password = $request->dni . '2023';
        $name = $request->first_name . ' ' . $request->last_name;
        $user = User::create([
            'email' => $email,
            'name' => $name,
            'password' => $password,
            'role' => 'leader',
        ]);

        $leader->user_id = $user->id;
        $leader->status = 'pendiente';
        $leader->type = 'leader';
        $leader->candidate = 'none';
        $leader->debate_boss = 'none';
        $leader->generatePublicUrlToken();
        $leader->save();

        $voter = Voter::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dni' => $request->dni,
            'phone' => $request->phone,
            'leader_id' => $leader->id,
            'place_id' => $request->place_id,
            'address' => 'none',
            'type' => 'leader',
            'candidate' => 'none',
            'status' => 'pendiente',
            'debate_boss' => 'none'
        ]);

        return redirect()->route('leaders.index')->with('success', 'Líder creado correctamente.');
    }


    /**
     * status
     *
     * @param  mixed $leader
     * @param  mixed $request
     * @return void
     */
    public function status(Leader $leader, Request $request)
    {
        $leader->status = $request->status;
        $leader->save();

        return redirect()->route('leaders.index')->with('success', 'Líder actualizado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function edit(Leader $leader)
    {
        $leader->generatePublicUrlToken();
        $user = Auth::user();
        if ($user->isAdmin()) {
            $places = Place::all();
            $coordinators = Coordinator::all();
            return view('leaders.edit', compact('leader', 'places', 'coordinators'));
        }
        elseif($user->hasRole('coordinator')){
            $places = Place::all();
            $coordinators = Coordinator::with(['place', 'users'])->where('user_id', $user->id)->get();
            return view('leaders.edit', compact('leader', 'places', 'coordinators'));
        }elseif($user->hasRole('leader')){
            $coordinators = Coordinator::where('id', $leader->coordinator_id)->get();
            $places = Place::all();
            return view('leaders.edit', compact('leader', 'places', 'coordinators'));
        }
         else {
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
        // Delete the user
        // If the leader has voters associated, they will be assigned to the leader with dni 1102812122
        $user = User::where('id', $leader->user_id)->first();
        $user->delete();

        if($leader->voters->count() > 0){
            $leader->voters()->update(['leader_id' => 1]);
        }

        // Delete the leader
        $leader->delete();
        return redirect()->route('leaders.index')->with('success', 'Líder eliminado correctamente.');
    }

    //generate link to public register voter from leader->generatePublicUrlToken()
    public function generatePublicUrlToken(Leader $leader)
    {
        $leader->generatePublicUrlToken();
        return $leader->public_url_token;
    }

}
