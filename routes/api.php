<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('create', [NewController::class, 'createteam']);
Route::get('alldata', [NewController::class, 'index']);
Route::post('addplayer', [NewController::class, 'addplayer']);
Route::get('viewplayer', [NewController::class, 'viewplayer']);
Route::post('club', [NewController::class, 'club']);
Route::get('viewclub/{id}', [NewController::class, 'viewclub']);
Route::delete('delete/{id}', [NewController::class, 'delete']);
Route::put('updateclub', [NewController::class, 'updateclub ']);
Route::any('{updateclub}', function(){
    return response()->json([
        'status'    => false,
        'message'   => 'Page Not Found.',
    ], 404);
})->where('updateclub', '.*');