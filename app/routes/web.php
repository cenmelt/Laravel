<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PwdController;
use App\Http\Controllers\teamsController;
use App\Http\Controllers\joinTeamController;
use App\Http\Controllers\Controller;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [
    Controller::class, 'welcome'
])->name('/');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/form',[
    Controller::class, 'forme'
])->name('Controller');

Route::get('/team', [
    Controller::class, 'team'
])->name('Controller');

Route::post('/PwdController', [
    PwdController::class, 'form'
])->name('PwdController');

Route::post('/teamsController', [
    teamsController::class, 'team'
])->name('teamsController');

Route::post('/joinTeamController', [
    joinTeamController::class, 'joinTeam'
])->name('joinTeamController');

Route::get('/password', [
    ListingController::class, 'getInfo'
])->name('ListingController');

Route::get('/change/{idpass}', function () {
    return view('change');
});
Route::get('/change/{idpass}', [
    PwdController::class, 'id'
])->name('id');

Route::post('/change/{idpass}', [
    PwdController::class, 'editPwd'
])->name('editPwd');