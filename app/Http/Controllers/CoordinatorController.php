<?php

namespace App\Http\Controllers;

use App\Models\Coordinator;
use App\Http\Requests\CoordinatorRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CoordinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $coordinators = Coordinator::when($search, function ($query) use ($search) {
            return $query->where('first_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%")
                ->orWhere('dni', 'like', "%$search%");
        })->paginate(10);

        return view('coordinator.index', compact('coordinators', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coordinator.create');
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

        $email = $coordinator->dni . '@' . $coordinator->first_name . '.com';
        $password = $coordinator->dni . 'Sigma2023';
        $user = User::create([
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'coordinator',
        ]);
        $coordinator->user()->associate($user);
        $coordinator->save();

        return redirect()->route('coordinator.index')->with('success', 'Coordinador creado Correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coordinator  $coordinator
     * @return \Illuminate\Http\Response
     */
    public function edit(Coordinator $coordinator)
    {
        return view('coordinator.edit', compact('coordinator'));
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
        return redirect()->route('coordinator.index')->with('success', 'Coordinador actualizado Correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coordinator  $coordinator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coordinator $coordinator)
    {
        $coordinator->delete();
        return redirect()->route('coordinator.index')->with('success','Coordinator Eliminado Correctamente');
    }
}