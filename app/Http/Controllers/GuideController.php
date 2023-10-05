<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuideRequest;
use App\Http\Requests\GuideUpdateRequest;
use App\Http\Requests\VoterRequest;
use App\Models\Leader;
use App\Models\Place;
use App\Models\Voter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Enums\EntityParent;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View|void
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole(['coordinator', 'leader']) || $user->isAdmin()) {
            $search = $request->input('search');
            $query = Voter::with('leader','place')->whereType('guide')->with('leader.coordinator');

            if ($user->hasRole('leader')) {
                $query->where('leader_id', $user->id);
            } elseif ($user->hasRole('coordinator')) {
                $leaderIds = $user->coordinator->leaders()->pluck('id')->toArray();
                $query->whereIn('leader_id', $leaderIds);
            }

            $voters = $query->when($search, function ($query) use ($search) {
                return $query->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('dni', 'like', "%$search%");
            })->orderBy('leader_id','asc')->paginate(10);

            if (session('success_message')) {
                Alert::success('Éxito', session('success_message'));
            }

            return view('guides.index', compact('voters', 'search'));
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|void
     */
    public function create()
    {
        $user = Auth::user();
        if($user->hasRole(['coordinator', 'leader']) || $user->isAdmin()) {
            $places = Place::all();
            $leaders = Leader::all();
            $entityParents = EntityParent::getValues();

            if ($user->hasRole('coordinator')) {
                $leaders = $user->coordinator->leaders;
            } elseif ($user->hasRole('leader')) {
                $leaders = $user->leader->where('id', $user->id);
            }
            return view('guides.create', compact('places', 'leaders', 'entityParents'));
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GuideRequest $request
     * @return RedirectResponse
     */
    public function store(GuideRequest $request): RedirectResponse
    {
        $voter = Voter::create($request->validated());

        $voter->candidate = 'none';
        $voter->debate_boss = 'none';
        $voter->save();

        return redirect()->route('guides.index')->with('success', 'Guía creado correctamente.');
    }

    /**
     * status
     *
     * @param  mixed $voter
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function status(Voter $voter, Request $request): RedirectResponse
    {
        $voter->status = $request->status;
        $voter->save();

        return redirect()->route('guides.index')->with('success', 'Votante actualizado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Voter $voter
     * @return Application|Factory|View|void
     */
    public function edit(Voter $voter)
    {
        $user = Auth::user();
        if($user->hasRole(['coordinator', 'leader']) || $user->isAdmin()) {
            $places = Place::all();
            $leaders = Leader::all();
            $entityParents = EntityParent::getValues();

            if ($user->hasRole('coordinator')) {
                $leaders = $user->coordinator->leaders;
            } elseif ($user->hasRole('leader')) {
                $leaders = $user->leader->where('id', $user->id);
            }
            return view('guides.edit', compact('places', 'leaders', 'voter', 'entityParents'));
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GuideUpdateRequest $request
     * @param Voter $voter
     * @return RedirectResponse
     */
    public function update(GuideUpdateRequest $request, Voter $voter): RedirectResponse
    {
        $voter->update($request->validated());
        return redirect()->route('guides.index')->with('success', 'Votante actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Voter $voter
     * @return RedirectResponse
     */
    public function destroy(Voter $voter): RedirectResponse
    {
        $voter->delete();
        return redirect()->route('guides.index')->with('success', 'Votante eliminado correctamente.');
    }

    //Public function without auth
    //function to show a view with public_url_token and leader_id setting
    /**
     * @param $public_url_token
     * @return Application|Factory|View
     */
    public function new_voter($public_url_token): View|Factory|Application
    {
        $leader = Leader::where('public_url_token','LIKE', $public_url_token)->first();
        $entityParents = EntityParent::getValues();
        $places = Place::all();
        $leader_id = $leader->id;

        return view('voters.public.create', compact('leader_id', 'public_url_token', 'leader', 'entityParents', 'places'));
    }

    /**
     * @param VoterRequest $request
     * @return RedirectResponse
     */
    public function save_voter(VoterRequest $request): RedirectResponse
    {
        $voter = Voter::create($request->validated());

        $voter->status = 'pendiente';
        $voter->type = 'guide';
        $voter->candidate = 'none';
        $voter->debate_boss = 'none';
        $voter->save();

        return redirect()->route('welcome')->with('success', 'Votante creado correctamente.');
    }
}
