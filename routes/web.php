<?php

use App\Helpers\Helper;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\LeaderController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\SmsController;
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
Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('voters/{public_url_token}/new', [VoterController::class, 'new_voter'])->name('voters.new');
Route::post('voters/new', [VoterController::class, 'save_voter'])->name('voters.save_voter');
//Auth routes
Route::middleware('auth')->group(function () {
    //Profile routes
    Route::get('profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //User routes
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    //Coordinator routes
    Route::resource('coordinators', CoordinatorController::class);
    Route::put('coordinators/{coordinator}/status', [CoordinatorController::class, 'status'])->name('coordinators.status');
    Route::get('coordinators/{id}/list', [CoordinatorController::class, 'list'])->name('coordinators.list');
    //Place routes
    Route::resource('places', PlaceController::class);
    //Leader routes
    Route::resource('leaders', LeaderController::class);
    Route::put('leaders/{leader}/status', [LeaderController::class, 'status'])->name('leaders.status');
    Route::get('leaders/{leader}/url_generate', [LeaderController::class, 'url_generate'])->name('leaders.url_generate');
    //Voter routes
    Route::resource('voters', VoterController::class);
    Route::put('voters/{voter}/status', [VoterController::class, 'status'])->name('voters.status');
    //Sms routes
    Route::resource('sms', SmsController::class)->only(['index', 'store']);
    Route::post('sms/link', [SmsController::class, 'link'])->name('sms.link');
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
    Route::get('places-export', [PlaceController::class,'export_excel'])->name('places.export.excel');
    // Route::post('places-import', 'import')->name('places.import');
});
