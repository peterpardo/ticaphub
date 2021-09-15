<?php

use App\Http\Controllers\ElectionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoterController;

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

Route::get('/', function () { return view('home'); })->name('home');

Route::get('/test', [ElectionController::class, 'test']);

Route::middleware(['guest'])->group(function(){
    Route::get('/users/set-password', [UserController::class, 'setPasswordForm'])->name('set-password');
    Route::post('/users/set-password', [UserController::class, 'setPassword']);
});


Route::middleware(['auth', 'set_ticap'])->group(function(){
    // SET TICAP NAME
    Route::get('/set-ticap', [HomeController::class, 'setTicap'])
        ->withoutMiddleware(['set_ticap'])
        ->name('set-ticap-name');
    Route::post('/set-ticap', [HomeController::class, 'addTicap'])
    ->withoutMiddleware(['set_ticap']);

    // DASHBOARD
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // USER ACCOUNTS
    Route::get('users/set-invitation', [UserController::class, 'invitationForm'])->name('set-invitation');
    Route::post('users/set-invitation', [UserController::class, 'setInvitation']);
    Route::get('/fetch-specializations', [UserController::class, 'fetchSpecializations']);
    Route::post('/add-specialization', [UserController::class, 'addSpecialization']);
    Route::post('/delete-specialization', [UserController::class, 'deleteSpecialization']);
    Route::middleware(['user_invitation'])->group(function(){
        Route::get('/users', [HomeController::class, 'users'])->name('users');
        Route::get('/users/add-user', [UserController::class, 'userForm'])->name('add-user');
        Route::post('/users/add-user', [UserController::class, 'addUser']);
        Route::post('/users', [UserController::class, 'resetUsers'])->name('reset-users');

        Route::get('/users/invite-users', [UserController::class, 'importUsers'])->name('invite-users');
        Route::post('/users/invite-users', [MailController::class, 'sendMultipleInvitation']);
        Route::post('/users/import-users', [MailController::class, 'importUsers'])->name('import-users');
        
    });

    // OFFICERS AND COMMITTEES
    Route::get('/officers-and-committees', [HomeController::class, 'officers'])
        ->middleware(['election'])
        ->name('officers');
    Route::middleware(['isAdmin'])->group(function(){
        Route::get('/officers-and-committees/positions', [ElectionController::class, 'setPositions'])->name('set-positions');
        Route::get('/fetch-positions', [ElectionController::class, 'fetchPositions']);
        Route::post('/add-position', [ElectionController::class, 'addPosition']);
        Route::post('/delete-position', [ElectionController::class, 'deletePosition']);
        Route::get('/officers-and-committees/candidates', [ElectionController::class, 'setCandidates'])->name('set-candidates');
        Route::get('/fetch-candidates', [ElectionController::class, 'fetchCandidates']);
        Route::get('/search-candidate', [ElectionController::class, 'search'])->name('appoint-candidate');
        Route::post('/add-candidate', [ElectionController::class, 'addCandidate']);
        Route::post('/delete-candidate', [ElectionController::class, 'deleteCandidate']);

        Route::get('/officers-and-committees/election', [ElectionController::class, 'electionPanel'])->name('election');
        Route::post('/officers-and-committees/election', [ElectionController::class, 'getElectionResults']);

        Route::get('/officers-and-committees/election-result', [ElectionController::class, 'electionResults'])->name('election-result');
        Route::post('/officers-and-committees/election-result', [ElectionController::class, 'endElection']);

        Route::get('/officers-and-committees/new-election', [ElectionController::class, 'newElectionPanel'])->name('new-election');
        Route::post('/officers-and-committees/new-election', [ElectionController::class, 'getNewElectionResults']);

        Route::get('/officers-and-committees/vote', [VoterController::class, 'voterPanel'])->name('vote');
        Route::post('/officers-and-committees/vote', [VoterController::class, 'getVote']);
    });
});

require __DIR__.'/auth.php';
