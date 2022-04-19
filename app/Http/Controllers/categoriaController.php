<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Categoria;
use App\User;
use Illuminate\Support\Facades\Hash;
use Log;

class categoriaController extends Controller
{
    public function new(Request $request)
    {  
        $user2=$request->user();
        if($user2->permiso != 1){
            return response()->json('no tienes permiso');
        }

        if(!$user2->tipo == 2){
            $user2->permiso=0;
            $user2->save();
        }

        $categoria = new Categoria();
        $categoria->nombre=$request->nombre; 
        $categoria->descripcion=$request->descripcion;
    
        if($categoria->save()){
            return response()->json($categoria);
        }
        return abort(402, "Error al Insertar");
    }



    public function update(Request $request)
    {  
        $user2=$request->user();
        if($user2->permiso != 1){
            return response()->json('no tienes permiso');
        }

        if(!$user2->tipo == 2){
            $user2->permiso=0;
            $user2->save();
        }

        $categoria = Categoria::find($request->id);
        $categoria->nombre=$request->nombre; 
        $categoria->descripcion=$request->descripcion;
    
        if($categoria->save()){
            return response()->json($categoria);
        }
        return abort(402, "Error al actualizar");
    }


    public function getAll(Request $request)
    {
        if($request->id){
            $categorias=Categoria::find ($request->id);
            return response()->json($categorias);
        }
        $categoria=Categoria::all();
        return response()->json($categoria);
    }


    public function getOne($id)
    {
            $categoria=Categoria::find ($id);
            return response()->json($categoria);
    }


    public function delete(Request $request)
    {
        $user2=$request->user();
        if($user2->permiso != 1){
            return response()->json('no tienes permiso');
        }

        if(!$user2->tipo == 2){
            $user2->permiso=0;
            $user2->save();
        }

        $categoria=DB::table('categorias')
        ->where('id','=',$request->id)
        ->delete();
            return response()->json('Eliminacion Exitosa!!');
    }
}
