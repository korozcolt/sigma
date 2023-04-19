<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->last_activity && now()->diffInMinutes($user->last_activity) > 120) {
            Auth::logout();
            return redirect('/login')->withErrors(['message' => 'You have been logged out due to inactivity.']);
        }

        if ($user) {
            $user->last_activity = now();
            $user->save();
        }

        return $next($request);
    }
}
