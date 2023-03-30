<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Services\TestService;

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

Route::get('/', function (Request $request) {
    $app1 = TestService::staticSetFruit('Apple');
    $app2 = TestService::staticSetFruit('Mango');
    return TestService::staticGetFruit();
});
Route::get('/test', function (Request $request) {
    $app1 = TestService::staticSetFruit('Ball');
    $app2 = TestService::staticSetFruit('Cat');
    return TestService::staticGetFruit();
});
Route::get('/controller-test', [AuthController::class, 'controllerTest']);
Route::prefix('auth')->group(function() {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('change-password', [AuthController::class, 'changePassword']);
});
Route::middleware('auth:a')->get('/user', function (Request $request) {
    return $request->user();
});
Route::fallback(function(){
    return response()->json([
        'success' => false,
        'message' => 'Route not found'
    ], 404);
});