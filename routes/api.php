<?php

use App\Http\Controllers\Mobile\AuthController;
use App\Http\Controllers\Mobile\CommitteeTaskController;
use App\Http\Controllers\Mobile\EventController;
use App\Http\Controllers\Mobile\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Public routes
// Route::get('/products', [ProductController::class, 'index']);
// Route::get('/products/{id}', [ProductController::class, 'show']);
// Route::get('/products/search/{name}', [ProductController::class, 'search']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // User Page
    Route::get('/home', [HomeController::class, 'home']);
    Route::get('/home/{taskId}', [HomeController::class, 'showTask']);
    Route::get('/user/{id}', [HomeController::class, 'showUser']);
    Route::post('/user/{id}', [HomeController::class, 'updateUser']);

    // Events
    Route::get('/events', [EventController::class, 'getEvents']);
    Route::get('/events/{eventId}', [EventController::class, 'showEvent']);
    Route::post('/events', [EventController::class, 'createEvent']);
    Route::delete('/events/{eventId}', [EventController::class, 'deleteEvent']);
    Route::put('/events/{eventId}', [EventController::class, 'updateEvent']);

    // Lists
    Route::post('/events/{eventId}', [EventController::class, 'createList']);
    Route::delete('/events/{eventId}/lists/{listId}', [EventController::class, 'deleteList']);
    Route::put('/events/{eventId}/lists/{listId}', [EventController::class, 'updateList']);

    // Tasks
    Route::get('/events/{eventId}/lists/{listId}/tasks/{taskId}', [EventController::class, 'showTask']);
    Route::post('/events/{eventId}/lists/{listId}', [EventController::class, 'createTask']);
    Route::delete('/events/{eventId}/lists/{listId}/tasks/{taskId}', [EventController::class, 'deleteTask']);
    Route::put('/events/{eventId}/lists/{listId}/tasks/{taskId}', [EventController::class, 'updateTask']);
    Route::post('/events/{eventId}/lists/{listId}/tasks/{taskId}', [EventController::class, 'createActivity']);
    Route::get('/officers', [EventController::class, 'getOfficers']);
    Route::get('/download/{path}', [EventController::class, 'download']);

    // Committee Tasks
    Route::get('/committees/{commId}', [CommitteeTaskController::class, 'index']);
    Route::get('/committees/{commId}/members', [CommitteeTaskController::class, 'getMembers']);
    Route::get('/committees/{commId}/tasks/{taskId}', [CommitteeTaskController::class, 'viewTask']);
    Route::post('/committees/{commId}', [CommitteeTaskController::class, 'addTask']);
    Route::put('/committees/{commId}/tasks/{taskId}', [CommitteeTaskController::class, 'editTask']);
    Route::delete('/committees/{commId}/tasks/{taskId}', [CommitteeTaskController::class, 'deleteTask']);
});
