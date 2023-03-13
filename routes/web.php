<?php

use App\Helpers\Helper;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::delete('users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    Route::resource('coordinators', \App\Http\Controllers\CoordinatorController::class);
    //update status by coordinator in the function status on CoordinatorController
    Route::put('coordinators/{coordinator}/status', [\App\Http\Controllers\CoordinatorController::class, 'status'])->name('coordinators.status');
    Route::resource('places', \App\Http\Controllers\PlaceController::class);
    Route::resource('leaders', \App\Http\Controllers\LeaderController::class);
    Route::put('leaders/{leader}/status', [\App\Http\Controllers\LeaderController::class, 'status'])->name('leaders.status');
    Route::resource('voters', \App\Http\Controllers\VoterController::class);
    Route::put('voters/{voter}/status', [\App\Http\Controllers\VoterController::class, 'status'])->name('voters.status');
    Route::resource('sms', \App\Http\Controllers\SmsController::class);
    Route::get('/sms-test', function () {
        $message = 'prueba mensajería';
        $contact = [
            'first_name'  => 'Kristian',
            'last_name'   => 'Klaus',
            'phone' => '3016859339'
        ];

        var_dump(Helper::sendSms($contact, $message));
    });

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
