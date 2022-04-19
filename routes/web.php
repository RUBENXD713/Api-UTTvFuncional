<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//metodos para Usuario

Route::middleware('auth:sanctum')->delete('LogOut','usuarioController@LogOut');
Route::middleware('auth:sanctum')->get('Perfil','usuarioController@index');

Route::post('Registro','usuarioController@Registro');
Route::post('Login','usuarioController@LogIn');

Route::put('Actualizar','usuarioController@actualizar')->middleware('admin');


//metodos para videos

Route::middleware('auth:sanctum')->get('index','videoController@getVideos');

Route::middleware('auth:sanctum')->get('video','videoController@video');

Route::middleware('auth:sanctum')->post('nuevo','videoController@nuevo');

Route::middleware('auth:sanctum')->put('like','videoController@likeVideo');

Route::middleware('auth:sanctum')->put('dislike','videoController@disLikeVideo');

Route::middleware('auth:sanctum')->get('buscador','videoController@buscador');