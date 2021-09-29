<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListController;
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

// HOME PAGE
Route::get('/', function () { return view('home'); })->name('home');
Route::get('/test', [ElectionController::class, 'test']);
Route::get('/studentLogin', function () { return view('studentLogin'); })->name('studentLogin');
Route::get('/schools', function () { return view('schools'); })->name('schools');
Route::get('/specialization', function () { return view('specialization'); })->name('specialization');
Route::get('/specialization/groupView', function () { return view('homepage.groupView'); })->name('groupView');
Route::get('/specialization/viewSpecialization', function () { return view('homepage.viewSpecialization'); })->name('viewSpecialization');
// PASSWORD RESET FOR FIRST LOGIN
Route::middleware(['guest'])->group(function(){
    Route::get('/users/set-password', [UserController::class, 'setPasswordForm'])->name('set-password');
    Route::post('/users/set-password', [UserController::class, 'setPassword']);
});
Route::middleware(['auth', 'set.ticap'])->group(function(){
    // SET TICAP NAME
    Route::get('/set-ticap', [HomeController::class, 'setTicap'])
        ->withoutMiddleware(['set.ticap'])
        ->name('set-ticap-name');
    Route::post('/set-ticap', [HomeController::class, 'addTicap'])
    ->withoutMiddleware(['set.ticap']);
    // DASHBOARD
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/officers-and-committees', [HomeController::class, 'officers'])->name('officers');
    Route::get('/awards', [AwardController::class, 'index'])->name('awards');
    // DOCUMENTATION
    Route::get('/documentation', [DocumentationController::class, 'index'])->name('documentation');
    Route::get('/documentation/{ticapId}', [DocumentationController::class, 'ticapFiles']);
    // ADMIN ROUTE
    Route::middleware(['admin'])->group(function(){
        // USER ACCOUNTS
        Route::middleware(['set.invitation'])->group(function(){
            Route::get('/users/set-invitation', [UserController::class, 'invitationForm'])->name('set-invitation');
            Route::post('/users/set-invitation', [UserController::class, 'setInvitation']);
            Route::get('/fetch-specializations', [UserController::class, 'fetchSpecializations']);
            Route::post('/add-specialization', [UserController::class, 'addSpecialization']);
            Route::post('/delete-specialization', [UserController::class, 'deleteSpecialization']);
        });
        Route::get('/users', [HomeController::class, 'users'])->name('users');
        Route::get('/users/add-student', [UserController::class, 'userForm'])->name('add-student');
        Route::post('/users/add-student', [UserController::class, 'addUser']);
        Route::get('/users/add-admin', [UserController::class, 'adminForm'])->name('add-admin');
        Route::post('/users/add-admin', [UserController::class, 'addAdmin']);
        Route::post('/users/add-panelist', [UserController::class, 'addPanelist']);
        Route::get('/users/add-panelist', [UserController::class, 'panelistForm'])->name('add-panelist');
        Route::get('/users/{userId}/edit-user', [UserController::class, 'editUserForm']);
        Route::post('/users/{userId}/edit-user', [UserController::class, 'editUser']);
        Route::get('/users/invite-users', [UserController::class, 'importUsers'])->name('import-users');
        Route::post('/users/invite-users', [UserController::class, 'importFile']);
        // OFFICERS AND COMMITTEES
        Route::get('/officers-and-committees/positions', [ElectionController::class, 'setPositions'])->name('set-positions');
        Route::get('/fetch-positions', [ElectionController::class, 'fetchPositions']);
        Route::post('/add-position', [ElectionController::class, 'addPosition']);
        Route::post('/delete-position', [ElectionController::class, 'deletePosition']);
        Route::get('/officers-and-committees/candidates', [ElectionController::class, 'setCandidates'])->name('set-candidates');
        Route::get('/fetch-candidates', [ElectionController::class, 'fetchCandidates']);
        Route::get('/search-candidate', [ElectionController::class, 'search']);
        Route::post('/add-candidate', [ElectionController::class, 'addCandidate']);
        Route::post('/delete-candidate', [ElectionController::class, 'deleteCandidate']);
        Route::get('/officers-and-committees/election', [ElectionController::class, 'electionPanel'])->name('election');
        Route::post('/officers-and-committees/election', [ElectionController::class, 'getElectionResults']);
        Route::get('/officers-and-committees/election-result', [ElectionController::class, 'electionResults'])->name('election-result');
        // Route::get('/officers-and-committees/end-election', [ElectionController::class, 'endElection'])->name('end-election');
        Route::get('/officers-and-committees/new-election', [ElectionController::class, 'newElectionPanel'])->name('new-election');
        Route::post('/officers-and-committees/new-election', [ElectionController::class, 'getNewElectionResults']);
    });
    // APPOINT COMMITTEE HEADS
    Route::get('/committee-heads', [ElectionController::class, 'appointForm'])->name('committee-heads');
    // EVENTS AND LISTS/TASKS
    Route::middleware(['officer'])->group(function(){
        Route::get('/events', [EventController::class, 'index'])->name('events');
        Route::post('/events/add-event', [EventController::class, 'addEvent']);
        Route::post('/events/delete-event', [EventController::class, 'deleteEvent']);
        Route::middleware(['event'])->group(function() {
            Route::get('/events/{eventId}', [EventController::class, 'viewEvent']);
            Route::post('/events/{eventId}/add-list', [EventController::class, 'addList']);
            Route::post('/events/{eventId}/delete-list', [EventController::class, 'deleteList']);
            Route::middleware(['list'])->group(function() {
                Route::get('/events/{eventId}/list/{listId}', [EventController::class, 'viewList']);
                Route::get('/events/{eventId}/list/{listId}/add-task', [EventController::class, 'addTaskForm']);
                Route::post('/events/{eventId}/list/{listId}/add-task', [EventController::class, 'addTask'])
                    ->withoutMiddleware(['list', 'event']);
                Route::post('/events/{eventId}/list/{listId}/delete-task', [EventController::class, 'deleteTask']);   
                Route::get('/events/{eventId}/list/{listId}/task/{taskId}', [EventController::class, 'viewTask']);
                Route::get('/events/{eventId}/list/{listId}/task/{taskId}/update-task', [EventController::class, 'updateTaskForm']);
                Route::post('/events/{eventId}/list/{listId}/task/{taskId}', [EventController::class, 'addActivity']);
                Route::post('/events/{eventId}/list/{listId}/task/{taskId}/update-task', [EventController::class, 'updateTask']);
                Route::post('/event/{eventId}/list/{listId}/task/{taskId}/move-task', [EventController::class, 'moveTask']);
                // Route::post('/delete-officer-from-task/{taskId}', [EventController::class, 'deleteOfficerFromTask']);
                // Route::post('/add-officer-to-task/{taskId}', [EventController::class, 'addOfficerToTask']);
            });
        });
    });
    Route::get('/search-member', [EventController::class, 'searchMember']);
    Route::get('/fetch-members/{taskId}', [EventController::class, 'fetchMembers']);
    Route::get('/fetch-activity/{taskId}', [EventController::class, 'fetchActivities']);
    Route::get('/event-files/{file}', [EventController::class, 'downloadEventFile']);
    Route::get('/fetch-files/{taskId}', [EventController::class, 'fetchFiles']);
    // STUDENT ROUTE
    Route::middleware(['student'])->group(function(){
        Route::get('/officers-and-committees/vote', [VoterController::class, 'voterPanel'])->name('vote');
        Route::post('/officers-and-committees/vote', [VoterController::class, 'getVote']);
    });
});

require __DIR__.'/auth.php';
