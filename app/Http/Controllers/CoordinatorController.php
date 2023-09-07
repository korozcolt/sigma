<?php

namespace App\Http\Controllers;

use App\Enums\EntityStatus;
use App\Http\Requests\CoordinatorUpdateRequest;
use App\Models\Coordinator;
use App\Http\Requests\CoordinatorRequest;
use App\Models\Leader;
use App\Models\Place;
use App\Models\User;
use App\Models\Voter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CoordinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole(['coordinator', 'leader','digitizer']) || $user->isAdmin()) {
            $search = $request->input('search');
            if ($user->isAdmin() || $user->isDigitizer()) {
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

    public function list(Coordinator $coordinator)
    {
        $user = Auth::user();
        if ($user->hasRole(['coordinator', 'digitizer']) || $user->isAdmin()) {
            $leaders = Leader::where('coordinator_id', $coordinator->id)->get();
            $voters = collect(); // initialize $voters as a Collection instance
            foreach ($leaders as $leader) {
                $voters = $voters->merge(Voter::where('leader_id', $leader->id)->get());
            }
            return view('coordinators.list', compact('voters'));
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    public function importFileCSV(){
        $user = Auth::user();
        if ($user->isAdmin()) {
            $invalidRows = [];
            return view('coordinators.import.index',compact('invalidRows'));
        }else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    public function importCSV(CoordinatorRequest $request)
    {
        $file = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), 'r');
        $invalidRows = [];
        $columnNames = fgetcsv($handle);
        $user = Auth::user();

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($columnNames, $row);
            $data['user_id'] = $user->id;
            $data['type'] = 'coordinator';
            $data['status'] = EntityStatus::PENDIENTE;
            $data['debate_boss'] = 'none';
            $data['candidate'] = 'none';
            $data['place_id'] = 1;

            $newRequest = new CoordinatorRequest();
            $newRequest->replace($data);
            $validator = $newRequest->getValidatorInstance();

            if ($validator->fails()) {
                $invalidRow = $row;
                $invalidRow[] = implode(', ', $validator->errors()->all());
                $invalidRows[] = $invalidRow;
            } else {
                Coordinator::create($data);
            }
        }

        fclose($handle);

        return view('coordinators.import.index',compact('invalidRows'));
}

    /**
     * Download a CSV example file for the Coordinator model.
     *
     * This function generates a CSV file with a header row containing
     * the fillable attributes of the Coordinator model. The user can
     * download this file as an example to use when importing data.
     *
     * @return StreamedResponse
     */
    public function downloadCSVExample()
    {
        // Define the column names for the CSV file
        $columnNames = (new Coordinator)->getFillable();
        $columnNames = array_diff($columnNames, ['type', 'status', 'debate_boss', 'candidate', 'place_id', 'user_id']);

        // Create a StreamedResponse to send the CSV data to the front-end
        return new StreamedResponse(function () use ($columnNames) {
            // Open a file handle for writing to the output stream
            $handle = fopen('php://output', 'w');

            // Write the column names to the first row of the CSV file
            fputcsv($handle, $columnNames);

            // Close the file handle
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="coordinator_example.csv"',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->hasRole(['coordinator', 'digitizer']) || $user->isAdmin()) {
            $places = Place::all();
            return view('coordinators.create', compact('places'));
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CoordinatorRequest $request
     * @return RedirectResponse
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
            'password' => $password,
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
        $leader->generatePublicUrlToken();

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
     * @param Coordinator $coordinator
     * @return Response
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
     * @param CoordinatorUpdateRequest $request
     * @param Coordinator $coordinator
     * @return Response
     */
    public function update(CoordinatorUpdateRequest $request, Coordinator $coordinator)
    {
        $coordinator->update($request->validated());
        return redirect()->route('coordinators.index')->with('success', 'Coordinador actualizado Correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Coordinator $coordinator
     * @return Response
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
