<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoChatController;

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


Route::post('/call/end', [VideoChatController::class, 'endCall']);
Route::post('/call/initiate', [VideoChatController::class, 'initiateCall']);
Route::post('/call/answer', [VideoChatController::class, 'answerCall']);
Route::post('/ice-candidate', [VideoChatController::class, 'iceCandidate']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
