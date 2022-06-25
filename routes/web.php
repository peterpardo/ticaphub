<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanelistController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoterController;
use App\Models\Group;
use App\Models\School;
use App\Models\Specialization;
use App\Models\Ticap;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

Route::view('/url', 'emails.certificate');

// HOME PAGE
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/about-ticap', function () {
    return view('about-ticap');
})->name('about-ticap');
Route::get('/test', [ElectionController::class, 'test']);
Route::get('/schools', function () {
    $admin = User::find(1);
    if ($admin->ticap_id == null) {
        return redirect('/');
    }
    $schools = School::where('is_involved', 1)->get();
    return view('schools', ['schools' => $schools]);
})->name('schools');
Route::get('/schools/{schoolId}/specializations', function ($schoolId) {
    $specializations = Specialization::where('school_id', $schoolId)->get();
    return view('specialization', ['specializations' => $specializations]);
});
Route::get('/specializations/{specId}/groups', function ($specId) {
    $groups = Group::where('specialization_id', $specId)->get();
    return view('homepage.groupView', ['groups' => $groups]);
});
Route::get('/group/{groupId}', function ($groupId) {
    $group = Group::find($groupId);

    return view('homepage.viewSpecialization', ['group' => $group]);
});

// ATTENDANCE FOR GUESTS
Route::get('/attendance/{eventId}', [EventController::class, 'attendance']);

// STUDENT CHOICE AWARD VOTE FORM
Route::get('/student-choice-award/{groupId}', [AwardController::class, 'studentChoiceVote']);

// PASSWORD RESET FOR FIRST LOGIN
Route::middleware(['guest'])->group(function () {
    Route::get('/users/set-password', [UserController::class, 'setPasswordForm'])->name('set-password');
    Route::post('/users/set-password', [UserController::class, 'setPassword']);
});

Route::middleware(['auth'])->group(function () {
    // DASHBOARD
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // SET TICAP NAME
    Route::post('/set-ticap', [HomeController::class, 'addTicap']);

    Route::middleware(['set.ticap'])->group(function () {
        // USER ACCOUNTS
        Route::get('/users', [HomeController::class, 'users'])->name('users');
        Route::get('/users/import-students', [AdminController::class, 'importStudents']);
        Route::post('/users/import-students', [AdminController::class, 'uploadFile']);
        Route::get('/get-schools', [AdminController::class, 'getSchools']);
        Route::get('/get-specializations/{id}', [AdminController::class, 'getSpecializations']);
        Route::get('/download-sample', [UserController::class, 'downloadImportStudentsExample']);
    });

    // Route::get('/users/schools', [HomeController::class, 'getSchools']);
    // Route::post('users/update-school-status', [HomeController::class, 'updateSchoolStatus']);
    // Route::get('/users/set-invitation', [UserController::class, 'invitationForm'])->name('set-invitation');
    // Route::post('/users/set-invitation', [UserController::class, 'setInvitation']);
    // Route::get('/fetch-specializations', [UserController::class, 'fetchSpecializations']);
    // Route::post('/add-specialization', [UserController::class, 'addSpecialization']);
    // Route::post('/delete-specialization', [UserController::class, 'deleteSpecialization']);



    // MANAGE USER PROFILE
    Route::get('/users/profile', [UserController::class, 'editProfile'])->name('profile.update');
    Route::post('/users/profile/update', [UserController::class, 'updateProfile'])->name('update.user.profile');

    // SCHEDULES (temporarily disabled)
    // Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules');
    // Route::get('/schedules/calendar', [ScheduleController::class, 'viewCalendar']);
    // Route::get('/schedules/events', [ScheduleController::class, 'getSchedules']);
    // Route::post('/schedules/create', [ScheduleController::class, 'addSchedule']);
    // Route::post('/schedules/delete/{id}', [ScheduleController::class, 'deleteSchedule']);
    // Route::post('/schedules/update/{id}', [ScheduleController::class, 'updateSchedule']);

    // DOCUMENTATION
    Route::middleware(['admin'])->group(function () {
        Route::get('/documentation', [DocumentationController::class, 'index'])->name('documentation');
        Route::post('/documentation/delete-ticap', [DocumentationController::class, 'deleteTicap']);
        Route::get('/documentation/{ticapId}', [DocumentationController::class, 'ticapFiles']);
        Route::get('/event-files/{file}', [EventController::class, 'downloadEventFile']);
        Route::get('/event-programs/{file}', [EventController::class, 'downloadEventPrograms']);
        Route::get('/group-files/{file}', [EventController::class, 'downloadGroupFiles']);
    });

    Route::middleware(['set.ticap', 'set.invitation'])->group(function () {
        // OFFICERS AND COMMITTEES
        Route::get('/officers-and-committees', [HomeController::class, 'officers'])->name('officers');

        // PANELISTS ROUTE
        Route::get('/evaluate-groups', [PanelistController::class, 'index'])->name('evaluate-groups');
        Route::post('/evaluate-groups', [PanelistController::class, 'computeGrades']);
        Route::get('/review-grades', [PanelistController::class, 'reviewGrades'])->name('review-grades');
        Route::post('/review-grades', [PanelistController::class, 'submitGrades']);
        Route::get('/change-grades', [PanelistController::class, 'changeGrades'])->name('change-grades');
        Route::post('/change-grades', [PanelistController::class, 'updateGrades']);
        Route::get('/set-individual-awards', [PanelistController::class, 'setIndividualAwards'])->name('set-individual-awards');
        Route::post('/set-individual-awards', [PanelistController::class, 'setAward']);
        Route::get('/results-panel', [PanelistController::class, 'resultsPanel'])->name('results-panel');

        // PROJECT ASSESSMENT
        Route::get('/awards', [AwardController::class, 'index'])->name('awards');
        Route::get('/set-rubrics', [AwardController::class, 'setRubrics'])->name('set-rubrics');
        Route::get('/create-rubric', [AwardController::class, 'createRubric'])->name('rubric');
        Route::post('/create-rubric', [AwardController::class, 'addRubric']);
        Route::get('/set-rubrics/{awardId}/add-rubric', [AwardController::class, 'addRubric']);
        Route::get('/set-panelist', [AwardController::class, 'setPanelist']);
        Route::get('/set-panelist/assign', [AwardController::class, 'assignPanelist']);
        Route::post('/set-panelist/assign', [AwardController::class, 'assign']);
        Route::get('/fetch-panelists', [AwardController::class, 'fetchPanelists']);
        Route::get('/award-review', [AwardController::class, 'awardReview']);
        Route::get('/confirm-awards', [AwardController::class, 'confirmAwards']);
        Route::get('/assessment-panel', [AwardController::class, 'assessmentPanel'])->name('assessment-panel');
        Route::post('/assessment-panel', [AwardController::class, 'generateResults']);
        Route::get('/review-results', [AwardController::class, 'reviewResults'])->name('review-results');
        Route::post('/review-results', [AwardController::class, 'finalizeEvaluation']);
        Route::get('/generate-awards', [AwardController::class, 'generateAwards']);
        Route::get('/generate-panelists', [AwardController::class, 'generatePanelists']);
        Route::get('/generate-graded-rubrics', [AwardController::class, 'generateGradedRubrics']);
        Route::get('/generate-rubrics', [AwardController::class, 'generateRubrics']);
        Route::get('/generate-certificates', [AwardController::class, 'generateCertificates']);
        Route::post('/email-winner-awards', [AwardController::class, 'emailWinnerAwards']);
        Route::post('/email-recognition', [AwardController::class, 'emailRecognition']);
        Route::post('/email-panelists', [AwardController::class, 'emailPanelists']);
        Route::post('/email-single-certificate', [AwardController::class, 'emailSingleCertificate']);
        Route::post('/email-group-certificate', [AwardController::class, 'emailGroupCertificate']);
        Route::post('/email-student-choice-certificate', [AwardController::class, 'emailStudentChoiceCertificate']);

        // SET TICAP
        Route::middleware(['invitation'])->group(function () {
            Route::get('/users/set-invitation', [UserController::class, 'invitationForm'])->name('set-invitation');
            Route::post('/users/set-invitation', [UserController::class, 'setInvitation']);
            Route::get('/fetch-specializations', [UserController::class, 'fetchSpecializations']);
            Route::post('/add-specialization', [UserController::class, 'addSpecialization']);
            Route::post('/delete-specialization', [UserController::class, 'deleteSpecialization']);
        });

        // ADMIN ROUTE
        Route::middleware(['admin', 'set.invitation'])->group(function () {
            // USER ACCOUNTS
            Route::get('/users/add-student', [UserController::class, 'userForm'])->name('add-student');
            Route::get('/users/add-admin', [UserController::class, 'adminForm'])->name('add-admin');
            Route::post('/users/add-admin', [UserController::class, 'addAdmin']);
            Route::post('/users/add-panelist', [UserController::class, 'addPanelist']);
            Route::get('/users/add-panelist', [UserController::class, 'panelistForm'])->name('add-panelist');
            Route::get('/users/{userId}/edit-user', [UserController::class, 'editUserForm']);
            Route::post('/users/{userId}/edit-user', [UserController::class, 'editUser']);
            Route::get('/users/invite-users', [UserController::class, 'importUsers'])->name('import-users');
            Route::post('/users/invite-users', [UserController::class, 'importFile']);
            Route::get('/users/groups', [UserController::class, 'groups']);
            Route::get('/users/groups/{id}', [UserController::class, 'viewGroup']);
            Route::get('/users/groups/{id}/edit', [UserController::class, 'editGroupFrom']);
            Route::post('/users/groups/{id}/edit', [UserController::class, 'editGroup']);
            Route::post('/get-specializations', [UserController::class, 'getSpecializations']);

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
            Route::get('/officers-and-committees/new-election', [ElectionController::class, 'newElectionPanel'])->name('new-election');
            Route::post('/officers-and-committees/new-election', [ElectionController::class, 'getNewElectionResults']);
            Route::get('/generate-officers', [ElectionController::class, 'generateOfficers']);

            // HOME SLIDER
            Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
            Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
            Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');
            Route::get('/slider/delete/{id}', [HomeController::class, 'deleteSlider']);

            //STREAM LINK
            Route::get('/home/stream', [HomeController::class, 'HomeStream'])->name('home.stream');
            Route::get('/add/stream', [HomeController::class, 'AddStream'])->name('add.stream');
            Route::post('/store/stream', [HomeController::class, 'StoreStream'])->name('store.stream');
            Route::get('/stream/delete/{id}', [HomeController::class, 'deleteStream']);

            // TICAP EVENTS
            Route::get('/home/brand', [HomeController::class, 'HomeBrand'])->name('home.brand');
            Route::get('/add/brand', [HomeController::class, 'AddBrand'])->name('add.brand');
            Route::post('/store/brand', [HomeController::class, 'StoreBrand'])->name('store.brand');
            Route::get('/brand/delete/{id}', [HomeController::class, 'deleteBrand']);
        });

        // EVENTS AND LISTS/TASKS
        Route::middleware(['officer'])->group(function () {
            Route::get('/events', [EventController::class, 'index'])->name('events');
            Route::get('/download-qr-code/{eventId}', [EventController::class, 'downloadCode']);
            Route::post('/events/add-event', [EventController::class, 'addEvent']);
            Route::post('/events/delete-event', [EventController::class, 'deleteEvent']);
            Route::get('/check-attendance', [AwardController::class, 'checkAttendance']);

            // APPOINT COMMITTEE HEADS
            Route::get('/committee-heads', [ElectionController::class, 'appointForm'])->name('committee-heads');
            Route::middleware(['event'])->group(function () {
                Route::get('/events/{eventId}', [EventController::class, 'viewEvent']);
                Route::post('/events/{eventId}/add-list', [EventController::class, 'addList']);
                Route::post('/events/{eventId}/delete-list', [EventController::class, 'deleteList']);
                Route::get('/events/{eventId}/program-flow', [EventController::class, 'programFlow']);
                Route::middleware(['list'])->group(function () {
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
                });
            });
        });

        Route::get('/activity-files/{path}', [EventController::class, 'downloadActivityFile']);
        Route::get('/search-member', [EventController::class, 'searchMember']);
        Route::get('/fetch-members/{taskId}', [EventController::class, 'fetchMembers']);
        Route::get('/fetch-activity/{taskId}', [EventController::class, 'fetchActivities']);
        Route::get('/fetch-files/{taskId}', [EventController::class, 'fetchFiles']);

        // STUDENT ROUTE
        Route::middleware(['student'])->group(function () {
            Route::get('/officers-and-committees/vote', [VoterController::class, 'voterPanel'])->name('vote');
            Route::post('/officers-and-committees/vote', [VoterController::class, 'getVote']);
            Route::get('/group-exhibit', [StudentController::class, 'index'])->name('exhibit');
            Route::get('/group-exhibit/{groupId}/update', [StudentController::class, 'updateForm']);
            Route::post('/group-exhibit/{groupId}/update', [StudentController::class, 'update']);

            // ASSIGN TASK TO COMMITTEE MEMBERS
            Route::get('/committee/{commId}', [CommitteeController::class, 'index']);
            Route::get('/committee/{commId}/add-task', [CommitteeController::class, 'addTaskForm']);
            Route::post('/committee/{commId}/add-task', [CommitteeController::class, 'addTask']);
            Route::get('/committee/{commId}/task/{taskId}/view-task', [CommitteeController::class, 'viewTask']);
            Route::get('/committee/{commId}/task/{taskId}/edit-task', [CommitteeController::class, 'editTaskForm']);
            Route::post('/committee/{commId}/task/{taskId}/edit-task', [CommitteeController::class, 'editTask']);
            Route::post('/committee/{commId}/delete-task', [CommitteeController::class, 'deleteTask']);
            Route::get('/committee/{commId}/add-member', [CommitteeController::class, 'addCommitteeMember']);
        });
        Route::get('/search-committee', [CommitteeController::class, 'searchCommittee']);
        Route::get('/fetch-committee/{taskId}', [CommitteeController::class, 'fetchCommittee']);
    });
});

require __DIR__ . '/auth.php';
