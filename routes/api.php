<?php

use App\Http\Controllers\DoctorController;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('search/{last}/{first}', static function ($last='', $first='') {
    return DoctorController::index($last, $first);
});
Route::get('search/{last}', static function ($last='') {
    return DoctorController::index($last, '');
});
Route::get('search', static function () {
    return DoctorController::index('', '');
});
