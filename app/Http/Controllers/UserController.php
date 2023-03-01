<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('coordinator') || $user->isAdmin() || $user->hasRole('leader')) {
            $users = User::paginate(10);
            return view('users.index', compact('users'));
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }
}
