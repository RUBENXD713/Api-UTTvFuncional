<?php
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//metodos para Usuario

Route::get('evento','usuarioController@event');


Route::middleware('auth:sanctum')->delete('/us/LogOut','usuarioController@LogOut');
Route::middleware('auth:sanctum')->get('/us/Perfil','usuarioController@perfil');
Route::middleware('auth:sanctum')->get('/us/index','usuarioController@index');
Route::post('/us/Registro','usuarioController@Registro');
Route::middleware('auth:sanctum')->put('/us/Actualizar','usuarioController@actualizar');
Route::middleware('auth:sanctum')->delete('/us/eliminar','usuarioController@drop');
Route::middleware('auth:sanctum')->get('/us/getOne','usuarioController@getOne');


Route::middleware('auth:sanctum')->get('/us/perfilAndroid','usuarioController@perfilAndroid');


Route::post('/us/loginAndorid','usuarioController@loginAndorid');
Route::post('/us/login','usuarioController@LogIn');
Route::middleware('auth:sanctum')->post('/us/login2','usuarioController@login2');
Route::middleware('auth:sanctum')->post('/us/login3','usuarioController@login3');


Route::post('/us/solicitarPermiso','usuarioController@solicitarPermiso');
Route::middleware('auth:sanctum')->post('/us/generarCodigo','usuarioController@generarCodigo');
Route::delete('/us/eliminarCodigo','usuarioController@eliminarCodigo');
Route::middleware('auth:sanctum')->post('/us/permisoNuevo','usuarioController@permiso');
Route::middleware('auth:sanctum')->get('/us/getPeticiones','usuarioController@getPeticiones');

//metodos para videos


Route::get('/vi/index','videoController@getVideos');
Route::get('/vi/index/id','videoController@getVideo');
Route::middleware('auth:sanctum')->delete('/vi/eliminar','videoController@drop');
Route::middleware('auth:sanctum')->put('/vi/actualizar','videoController@actualizar');
Route::middleware('auth:sanctum')->post('/vi/nuevo','videoController@nuevo');


Route::middleware('auth:sanctum')->get('/vi/carrera','videoController@carrera');


Route::get('/vi/video','videoController@video');
Route::put('/vi/like','videoController@likeVideo');
Route::put('/vi/dislike','videoController@disLikeVideo');
Route::get('/vi/buscador','videoController@buscador');


//metodos para carreras


Route::get('/car/index','carreraController@getAll');
Route::get('/car/index/id','carreraController@getOne');
Route::middleware('auth:sanctum')->delete('/car/drop','carreraController@delete');
Route::middleware('auth:sanctum')->put('/car/update','carreraController@update');
Route::middleware('auth:sanctum')->post('/car/new','carreraController@new');


//metodos para categorias


Route::get('/cat/index','categoriaController@getAll');
Route::get('/cat/index/id','categoriaController@getOne');
Route::middleware('auth:sanctum')->delete('/cat/drop','categoriaController@delete');
Route::middleware('auth:sanctum')->put('/cat/update','categoriaController@update');
Route::middleware('auth:sanctum')->post('/cat/new','categoriaController@new');















