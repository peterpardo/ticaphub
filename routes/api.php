<?php

use App\Http\Controllers\Mobile\AuthController;
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
    
    // Home Page
    Route::get('/home', [HomeController::class, 'home']);

    // Events
    Route::get('/events', [EventController::class, 'getEvents']);
    Route::get('/events/{eventId}', [EventController::class, 'showEvent']);
    Route::post('/events', [EventController::class, 'createEvent']);
    Route::delete('/events/{eventId}', [EventController::class, 'deleteEvent']);
    Route::put('/events/{eventId}', [EventController::class, 'updateEvent']);

    // Lists
    // Route::get('/events/{eventId}/lists/{listId}', [EventController::class, 'showList']);
    Route::post('/events/{eventId}', [EventController::class, 'createList']);
    Route::delete('/events/{eventId}/lists/{listId}', [EventController::class, 'deleteList']);
    Route::put('/events/{eventId}/lists/{listId}', [EventController::class, 'updateList']);

    // Tasks
    Route::get('/events/{eventId}/lists/{listId}/tasks/{taskId}', [EventController::class, 'showTask']);
    Route::post('/events/{eventId}/lists/{listId}', [EventController::class, 'createTask']);
    Route::delete('/events/{eventId}/lists/{listId}/tasks/{taskId}', [EventController::class, 'deleteTask']);
    Route::put('/events/{eventId}/lists/{listId}/tasks/{taskId}', [EventController::class, 'updateTask']);
    Route::post('/events/{eventId}/lists/{listId}/tasks/{taskId}', [EventController::class, 'createActivity']);
});
