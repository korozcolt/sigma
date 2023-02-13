<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Http\Requests\PlaceRequest;

class PlaceController extends Controller
{
    /**
     * Display a listing of the places.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::paginate(10);
        return view('places.index', compact('places'));
    }

    /**
     * Show the form for creating a new place.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('places.create');
    }

    /**
     * Store a newly created place in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaceRequest $request)
    {
        $table = $request->input('table');
        for ($i = 1; $i <= $table; $i++) {
            Place::create([
                'place' => $request->input('place'),
                'table' => $i
            ]);
        }

        return redirect()->route('places.index')->with('success', 'Place created successfully');
    }

    /**
     * Show the form for editing the specified place.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Place::findOrFail($id);
        return view('places.edit', compact('place'));
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
    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $place->delete();
        return redirect()->route('places.index')->with('success', 'Place deleted successfully');
    }
}