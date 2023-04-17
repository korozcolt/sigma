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
require __DIR__ . '/auth.php';
//Public routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('voters/{public_url_token}/new', [\App\Http\Controllers\VoterController::class, 'new_voter'])->name('voters.new');
Route::post('voters/new', [\App\Http\Controllers\VoterController::class, 'save_voter'])->name('voters.save_voter');

//Auth routes
Route::middleware('auth')->group(function () {
    //Profile routes
    Route::get('profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //User routes
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::delete('users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    //Coordinator routes
    Route::resource('coordinators', \App\Http\Controllers\CoordinatorController::class);
    Route::put('coordinators/{coordinator}/status', [\App\Http\Controllers\CoordinatorController::class, 'status'])->name('coordinators.status');
    Route::get('coordinators/{id}/list', [\App\Http\Controllers\CoordinatorController::class, 'list'])->name('coordinators.list');
    //Place routes
    Route::resource('places', \App\Http\Controllers\PlaceController::class);
    //Leader routes
    Route::resource('leaders', \App\Http\Controllers\LeaderController::class);
    Route::put('leaders/{leader}/status', [\App\Http\Controllers\LeaderController::class, 'status'])->name('leaders.status');

    //Generate url for new public voters from leader
    Route::get('leaders/{leader}/url_generate', [\App\Http\Controllers\LeaderController::class, 'url_generate'])->name('leaders.url_generate');
    //Voter routes
    Route::resource('voters', \App\Http\Controllers\VoterController::class);
    Route::put('voters/{voter}/status', [\App\Http\Controllers\VoterController::class, 'status'])->name('voters.status');
    //Sms routes
    Route::resource('sms', \App\Http\Controllers\SmsController::class)->only(['index', 'store']);
    Route::post('sms/link', [\App\Http\Controllers\SmsController::class, 'link'])->name('sms.link');
    Route::get('/sms-test', function () {
        $message = 'prueba mensajería';
        $contact = [
            'first_name'  => 'Kristian',
            'last_name'   => 'Klaus',
            'phone' => '3016859339'
        ];

        var_dump(Helper::sendSms($contact, $message));
    });
    //Report routes
    Route::get('places-export', [\App\Http\Controllers\PlaceController::class,'export_excel'])->name('places.export.excel');
    // Route::post('places-import', 'import')->name('places.import');
});
