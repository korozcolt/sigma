<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Http\Requests\PlaceRequest;
use Illuminate\Support\Facades\Auth;
use App\Exports\PlacesExport;
use App\Imports\PlacesImport;
use Maatwebsite\Excel\Facades\Excel;

class PlaceController extends Controller
{
    /**
     * Display a listing of the places.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $places = Place::paginate(10);
            return view('places.index', compact('places'));
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    /**
     * Show the form for creating a new place.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            return view('places.create');
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }
    /**
     * Export places to excel
     *
     * @return \Illuminate\Http\Response
     */

    public function export_excel(){
        return Excel::download(new PlacesExport, 'lugar_de_votaciones.xlsx');
    }

    /**
     * Store a newly created place in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaceRequest $request)
    {
        $request->validated();
        $table = $request->input('table');
        for ($i = 1; $i <= $table; $i++) {
            Place::create([
                'place' => $request->input('place'),
                'table' => $i
            ]);
        }

        return redirect()->route('places.index')->withSuccess('Puesto de votación creado exitosamente');
    }

    /**
     * Show the form for editing the specified place.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            return view('places.edit', compact('place'));
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    /**
     * Update the specified place in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlaceRequest $request, $id)
    {
        $place = Place::findOrFail($id);
        $place->update($request->all());
        return redirect()->route('places.index')->with('success', 'Place updated successfully');
    }

    /**
     * Remove the specified place from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        $place->delete();
        return redirect()->route('places.index')->with('success', 'Place deleted successfully');
    }
}