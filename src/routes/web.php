<?php

use App\Http\Controllers\PiglyController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
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

Route::post('/register/step1', [RegisteredUserController::class, 'store']);
Route::get('/register/step2', function () {
    return view('auth.register2');
})->middleware('auth');
Route::post('/register/step2', [PiglyController::class, 'registerStep2'])->middleware('auth');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/weight_logs', [PiglyController::class, 'index']);
    Route::post('/weight_logs/create', [PiglyController::class, 'store']);
    Route::get('/weight_logs/search', [PiglyController::class, 'search']);
    Route::get('/weight_logs/{weightLogId}', [PiglyController::class, 'show']);
    Route::patch('/weight_logs/{weightLogId}/update', [PiglyController::class, 'update']);
    Route::delete('/weight_logs/{weightLogId}/delete', [PiglyController::class, 'destroy']);
    Route::get('/weight_logs/goal_setting', [PiglyController::class, 'goalSetting']);
    Route::post('/weight_logs/goal_setting', [PiglyController::class, 'goalUpdate']);
});
