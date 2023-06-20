<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Categories\CategoriesController;
use App\Http\Controllers\Api\V1\Communities\CommunitiesController;
use App\Http\Controllers\Api\V1\Devices\DevicesController;
use App\Http\Controllers\Api\V1\Devices\DevicesHardwareController;
use App\Http\Controllers\Api\V1\Exercises\ExercisesController;
use App\Http\Controllers\Api\V1\MachineLearning\MachineLearningController;
use App\Http\Controllers\Api\V1\MySessions\MySessionsController;
use App\Http\Controllers\Api\V1\Reports\ReportsController;
use App\Http\Controllers\Api\V1\Reports\ReportsMachineController;
use App\Http\Controllers\Api\V1\Tasks\TasksController;
use App\Http\Controllers\Api\V1\Users\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1'], function () {

    // Public Routes :
    // - Authentication : LOGIN & Register
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    // - Reset Password
    Route::post('/forget-password', [AuthController::class, 'forgetPassword']);
    // - Get Hardware Data
    Route::apiResource('/devices-hardware', DevicesHardwareController::class);

    // - Send user Data To Report Model
    Route::get('/report-machine/{user}/{date?}', [ReportsMachineController::class, 'show']);

    // - Send Data For Machine Learning Model
    Route::get('/machine-model/{id?}', [MachineLearningController::class, 'show']);

    //========================================================
    // Private Routes :
    Route::group(['middleware' => ['auth:sanctum']], function () {

        // - Email Verification
        Route::get('/send-verify-email/{email}', [AuthController::class, 'sendVerifyEmail']);

        // user Profile
        Route::apiResource('/user', UsersController::class);

        // -  App Data Endpoints
        Route::apiResource('/tasks', TasksController::class);
        Route::apiResource('/exercises', ExercisesController::class);
        Route::apiResource('/categories', CategoriesController::class);
        Route::apiResource('/reports', ReportsController::class);
        Route::apiResource('/devices', DevicesController::class);
        Route::apiResource('/my-sessions', MySessionsController::class);
        Route::apiResource('/communities', CommunitiesController::class);
        Route::post('/communities/{community}/join', [CommunitiesController::class, 'join']);
        Route::post('/communities/{community}/leave', [CommunitiesController::class, 'leave']);
        // - Logout
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
