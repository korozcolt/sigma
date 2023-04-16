<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $users = User::paginate(10);
            return view('users.index', compact('users'));
        } else {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success_message', 'Usuario eliminado con éxito.');
    }
}
