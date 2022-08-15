<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanelistController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
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

Route::view('/url', 'emails.certificate');

// GUEST ROUTES
Route::get('/', [GuestController::class, 'index'])->name('home');
Route::get('/schools/{id?}', [GuestController::class, 'schools'])->name('schools');
Route::get('/specializations/{id}', [GuestController::class, 'specialization']);
Route::get('/groups/{id}', [GuestController::class, 'group']);

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

    // VIEW PROFILE
    Route::get('/view-profile', [UserController::class, 'viewProfile'])->name('view-profile');

    Route::middleware(['set.ticap', 'admin'])->group(function () {
        // USER ACCOUNTS
        Route::get('/users', [AdminController::class, 'users'])->name('users');

        // SETTINGS
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings', [AdminController::class, 'endEvent']);
    });

    // USER ACCOUNTS AND SETTINGS
    Route::middleware(['set.ticap', 'set.invitation', 'admin'])->group(function () {
        // USER ACCOUNTS (GROUPS, ADVISERS, IMPORT STUDENTS)
        Route::get('/users/groups', [AdminController::class, 'groups']);
        Route::get('/users/project-advisers', [AdminController::class, 'projectAdvisers']);
        Route::get('/users/import-students', [AdminController::class, 'importStudents'])->name('import-students');
        Route::post('/users/import-students', [AdminController::class, 'uploadFile']);

        Route::get('/users/{id}', [AdminController::class, 'viewUser']);

        // URL for downloading student list template
        Route::get('/download-sample', [AdminController::class, 'downloadImportStudentsExample']);

        // Used for "/users/import-students" route
        Route::get('/get-schools', [AdminController::class, 'getSchools']);
        Route::get('/get-specializations/{id}', [AdminController::class, 'getSpecializations']);

        // SETTINGS (SPECIALIZATIONS)
        Route::get('/settings/specializations', [AdminController::class, 'specializations']);
    });

    // OFFICERS
    Route::middleware(['set.ticap', 'set.invitation', 'student.or.admin'])->group(function () {
        // LIST OF ELECTION (superadmin and admin only)
        Route::get('/officers/elections', [AdminController::class, 'elections'])->middleware('admin');

        // OFFICERS
        Route::get('/officers/{id}', [HomeController::class, 'officers'])
            ->name('officers');

        // SETTING OF ELECTION (superadmin and admin only)
        Route::middleware(['admin', 'election.status'])->group(function () {
            Route::get('/officers/set-positions/{id}', [AdminController::class, 'setPositions']);
            Route::get('/officers/set-candidates/{id}', [AdminController::class, 'setCandidates']);
            Route::get('/officers/review-election/{id}', [AdminController::class, 'reviewElection']);
        });

        // OVERVIEW OF ELECTION (superadmin, admin, and student)
        Route::get('/officers/elections/{id}', [AdminController::class, 'election'])->name('election');

        // VOTING PAGE (students)
        Route::get('/officers/elections/{id}/vote', [StudentController::class, 'vote'])->middleware('student');
    });

    // GROUP EXHIBIT (FOR STUDENTS)
    Route::middleware(['student'])->group(function () {
        Route::get('/group-exhibit', [UserController::class, 'groupExhibit'])->name('group-exhibit');
    });

    // PROJECT ASSESSMENT
    Route::middleware(['set.ticap', 'set.invitation', 'admin'])->group(function () {
        Route::get('/project-assessment', [AdminController::class, 'viewSpecializations'])->name('project-assessment');
        Route::get('/project-assessment/rubrics', [AdminController::class, 'rubrics']);

        Route::middleware('specialization.exists')->group(function () {
            Route::middleware('specialization.status')->group(function () {
                Route::get('/project-assessment/{id}', [AdminController::class, 'viewSpecialization'])->whereNumber('id');
                Route::get('/project-assessment/set-panelists/{id}', [AdminController::class, 'setPanelists'])->whereNumber('id');
                Route::get('/project-assessment/review-settings/{id}', [AdminController::class, 'reviewSettings'])->whereNumber('id');
            });

            Route::get('/project-assessment/view-panelists/{id}', [AdminController::class, 'viewPanelists'])->whereNumber('id');
        });
    });

    // GRADE GROUPS (for panelists)
    Route::middleware(['panelist'])->group(function () {
        Route::get('/grade-groups', [PanelistController::class, 'viewSpecializations'])->name('grade-groups');

        Route::middleware(['specialization.exists', 'specialization.status'])->group(function () {
            Route::get('/grade-groups/{id}', [PanelistController::class, 'viewAwards']);
        });
    });

    // DOCUMENTATION
    Route::middleware(['superadmin'])->group(function () {
        Route::get('/documentation', [DocumentationController::class, 'ticaps'])->name('documentation');
        Route::get('/documentation/{id}', [DocumentationController::class, 'viewTicap']);
        Route::get('/documentation/download-exhibit-files/{id}', [DocumentationController::class, 'downloadExhibitFiles']);
    });

    // SCHEDULES (temporarily disabled)
    // Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules');
    // Route::get('/schedules/calendar', [ScheduleController::class, 'viewCalendar']);
    // Route::get('/schedules/events', [ScheduleController::class, 'getSchedules']);
    // Route::post('/schedules/create', [ScheduleController::class, 'addSchedule']);
    // Route::post('/schedules/delete/{id}', [ScheduleController::class, 'deleteSchedule']);
    // Route::post('/schedules/update/{id}', [ScheduleController::class, 'updateSchedule']);

    Route::middleware(['set.ticap', 'set.invitation'])->group(function () {
        // OFFICERS AND COMMITTEES
        // Route::get('/officers-and-committees', [HomeController::class, 'officers'])->name('officers');

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
        // Route::get('/awards', [AwardController::class, 'index'])->name('awards');
        // Route::get('/set-rubrics', [AwardController::class, 'setRubrics'])->name('set-rubrics');
        // Route::get('/create-rubric', [AwardController::class, 'createRubric'])->name('rubric');
        // Route::post('/create-rubric', [AwardController::class, 'addRubric']);
        // Route::get('/set-rubrics/{awardId}/add-rubric', [AwardController::class, 'addRubric']);
        // Route::get('/set-panelist', [AwardController::class, 'setPanelist']);
        // Route::get('/set-panelist/assign', [AwardController::class, 'assignPanelist']);
        // Route::post('/set-panelist/assign', [AwardController::class, 'assign']);
        // Route::get('/fetch-panelists', [AwardController::class, 'fetchPanelists']);
        // Route::get('/award-review', [AwardController::class, 'awardReview']);
        // Route::get('/confirm-awards', [AwardController::class, 'confirmAwards']);
        // Route::get('/assessment-panel', [AwardController::class, 'assessmentPanel'])->name('assessment-panel');
        // Route::post('/assessment-panel', [AwardController::class, 'generateResults']);
        // Route::get('/review-results', [AwardController::class, 'reviewResults'])->name('review-results');
        // Route::post('/review-results', [AwardController::class, 'finalizeEvaluation']);
        // Route::get('/generate-awards', [AwardController::class, 'generateAwards']);
        // Route::get('/generate-panelists', [AwardController::class, 'generatePanelists']);
        // Route::get('/generate-graded-rubrics', [AwardController::class, 'generateGradedRubrics']);
        // Route::get('/generate-rubrics', [AwardController::class, 'generateRubrics']);
        // Route::get('/generate-certificates', [AwardController::class, 'generateCertificates']);
        // Route::post('/email-winner-awards', [AwardController::class, 'emailWinnerAwards']);
        // Route::post('/email-recognition', [AwardController::class, 'emailRecognition']);
        // Route::post('/email-panelists', [AwardController::class, 'emailPanelists']);
        // Route::post('/email-single-certificate', [AwardController::class, 'emailSingleCertificate']);
        // Route::post('/email-group-certificate', [AwardController::class, 'emailGroupCertificate']);
        // Route::post('/email-student-choice-certificate', [AwardController::class, 'emailStudentChoiceCertificate']);

        // SET TICAP
        // Route::middleware(['invitation'])->group(function () {
        //     Route::get('/users/set-invitation', [UserController::class, 'invitationForm'])->name('set-invitation');
        //     Route::post('/users/set-invitation', [UserController::class, 'setInvitation']);
        //     Route::get('/fetch-specializations', [UserController::class, 'fetchSpecializations']);
        //     Route::post('/add-specialization', [UserController::class, 'addSpecialization']);
        //     Route::post('/delete-specialization', [UserController::class, 'deleteSpecialization']);
        // });

        // ADMIN ROUTE
        // Route::middleware(['admin', 'set.invitation'])->group(function () {
        //     // USER ACCOUNTS
        //     Route::get('/users/add-student', [UserController::class, 'userForm'])->name('add-student');
        //     Route::get('/users/add-admin', [UserController::class, 'adminForm'])->name('add-admin');
        //     Route::post('/users/add-admin', [UserController::class, 'addAdmin']);
        //     Route::post('/users/add-panelist', [UserController::class, 'addPanelist']);
        //     Route::get('/users/add-panelist', [UserController::class, 'panelistForm'])->name('add-panelist');
        //     Route::get('/users/{userId}/edit-user', [UserController::class, 'editUserForm']);
        //     Route::post('/users/{userId}/edit-user', [UserController::class, 'editUser']);
        //     Route::get('/users/invite-users', [UserController::class, 'importUsers'])->name('import-users');
        //     Route::post('/users/invite-users', [UserController::class, 'importFile']);
        //     Route::get('/users/groups', [UserController::class, 'groups']);
        //     Route::get('/users/groups/{id}', [UserController::class, 'viewGroup']);
        //     Route::get('/users/groups/{id}/edit', [UserController::class, 'editGroupFrom']);
        //     Route::post('/users/groups/{id}/edit', [UserController::class, 'editGroup']);
        //     Route::post('/get-specializations', [UserController::class, 'getSpecializations']);

        //     // OFFICERS AND COMMITTEES
        //     Route::get('/officers-and-committees/positions', [ElectionController::class, 'setPositions'])->name('set-positions');
        //     Route::get('/fetch-positions', [ElectionController::class, 'fetchPositions']);
        //     Route::post('/add-position', [ElectionController::class, 'addPosition']);
        //     Route::post('/delete-position', [ElectionController::class, 'deletePosition']);
        //     Route::get('/officers-and-committees/candidates', [ElectionController::class, 'setCandidates'])->name('set-candidates');
        //     Route::get('/fetch-candidates', [ElectionController::class, 'fetchCandidates']);
        //     Route::get('/search-candidate', [ElectionController::class, 'search']);
        //     Route::post('/add-candidate', [ElectionController::class, 'addCandidate']);
        //     Route::post('/delete-candidate', [ElectionController::class, 'deleteCandidate']);
        //     Route::get('/officers-and-committees/election', [ElectionController::class, 'electionPanel'])->name('election');
        //     Route::post('/officers-and-committees/election', [ElectionController::class, 'getElectionResults']);
        //     Route::get('/officers-and-committees/election-result', [ElectionController::class, 'electionResults'])->name('election-result');
        //     Route::get('/officers-and-committees/new-election', [ElectionController::class, 'newElectionPanel'])->name('new-election');
        //     Route::post('/officers-and-committees/new-election', [ElectionController::class, 'getNewElectionResults']);
        //     Route::get('/generate-officers', [ElectionController::class, 'generateOfficers']);

        //     // HOME SLIDER
        //     Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
        //     Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
        //     Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');
        //     Route::get('/slider/delete/{id}', [HomeController::class, 'deleteSlider']);

        //     //STREAM LINK
        //     Route::get('/home/stream', [HomeController::class, 'HomeStream'])->name('home.stream');
        //     Route::get('/add/stream', [HomeController::class, 'AddStream'])->name('add.stream');
        //     Route::post('/store/stream', [HomeController::class, 'StoreStream'])->name('store.stream');
        //     Route::get('/stream/delete/{id}', [HomeController::class, 'deleteStream']);

        //     // TICAP EVENTS
        //     Route::get('/home/brand', [HomeController::class, 'HomeBrand'])->name('home.brand');
        //     Route::get('/add/brand', [HomeController::class, 'AddBrand'])->name('add.brand');
        //     Route::post('/store/brand', [HomeController::class, 'StoreBrand'])->name('store.brand');
        //     Route::get('/brand/delete/{id}', [HomeController::class, 'deleteBrand']);
        // });

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
        // Route::middleware(['student'])->group(function () {
        //     Route::get('/officers-and-committees/vote', [VoterController::class, 'voterPanel'])->name('vote');
        //     Route::post('/officers-and-committees/vote', [VoterController::class, 'getVote']);
        //     Route::get('/group-exhibit', [StudentController::class, 'index'])->name('exhibit');
        //     Route::get('/group-exhibit/{groupId}/update', [StudentController::class, 'updateForm']);
        //     Route::post('/group-exhibit/{groupId}/update', [StudentController::class, 'update']);

        //     // ASSIGN TASK TO COMMITTEE MEMBERS
        //     Route::get('/committee/{commId}', [CommitteeController::class, 'index']);
        //     Route::get('/committee/{commId}/add-task', [CommitteeController::class, 'addTaskForm']);
        //     Route::post('/committee/{commId}/add-task', [CommitteeController::class, 'addTask']);
        //     Route::get('/committee/{commId}/task/{taskId}/view-task', [CommitteeController::class, 'viewTask']);
        //     Route::get('/committee/{commId}/task/{taskId}/edit-task', [CommitteeController::class, 'editTaskForm']);
        //     Route::post('/committee/{commId}/task/{taskId}/edit-task', [CommitteeController::class, 'editTask']);
        //     Route::post('/committee/{commId}/delete-task', [CommitteeController::class, 'deleteTask']);
        //     Route::get('/committee/{commId}/add-member', [CommitteeController::class, 'addCommitteeMember']);
        // });
        // Route::get('/search-committee', [CommitteeController::class, 'searchCommittee']);
        // Route::get('/fetch-committee/{taskId}', [CommitteeController::class, 'fetchCommittee']);
    });
});

require __DIR__ . '/auth.php';
