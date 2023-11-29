<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Apicontroller;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
//});

// Open Routes 
 Route::post("register",[Apicontroller::class,"register"]);
 Route::post("login",[Apicontroller::class,"login"]);

 // Protected 
 Route::group([
    "middleware" => ["auth:api"]
 ], function(){
    Route::get("profile",[Apicontroller::class,"profile"]);
    Route::get("logout",[Apicontroller::class,"logout"]);
    
 });