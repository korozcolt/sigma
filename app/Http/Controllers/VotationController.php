<?php

namespace App\Http\Controllers;

use App\Models\Passport;
use App\Models\Relation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Votation;
use RealRashid\SweetAlert\Facades\Alert;

class VotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index($pass): View|Factory|Application
    {
        if(Passport::where('password', $pass)->first()){
            $votations = Votation::all();
            return view('votations.index', compact('votations'));
        }

        abort(403, 'No tienes permiso para acceder a esta página.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Application|Factory|RedirectResponse|View
     */
    public function create(Request $request): View|Factory|Application|RedirectResponse
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $cedula
     * @return JsonResponse
     */
    public function show($cedula): JsonResponse
    {
        $votation = Votation::where('cedula', $cedula)->first();

        if ($votation) {
            return response()->json($votation);
        }

        return response()->json(null);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $cedula = $request->input('cedula');
        $relation = Relation::where('cedula', $cedula)->first();
        $votation = Votation::where('cedula', $cedula)->first();

        if($relation) {
            $votation->type = 'YES';
            $votation->save();

            return response()->json([
                'message' => 'Voto registrado correctamente',
                'status' => 'success',
                'option' => 'YES'
            ]);
        }

        $votation->type = 'OPINION';
        $votation->save();

        return response()->json([
            'message' => 'Voto registrado correctamente',
            'status' => 'success',
            'option' => 'OPINION'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(): Factory|View|Application
    {
        return view('votations.login');
    }

    public function tokenGenerate(Request $request): RedirectResponse
    {
        if($request->has('password')){
            $password = $request->input('password');
            $isExist = Passport::where('password', $password)->first();
            if($isExist) {
                return redirect()->route('votations.index', $password);
            }

            Alert::error('Error', 'Contraseña incorrecta');
            return redirect()->route('votations.login');
        }

        Alert::error('Error', 'Contraseña incorrecta');
        return redirect()->route('votations.login');
    }
}
