<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Carrera;
use App\User;
use Illuminate\Support\Facades\Hash;
use Log;

class carreraController extends Controller
{
    public function new(Request $request)
    {  
        $carreras = new Carrera();
        $carreras->nombre=$request->nombre; 
        $carreras->descripcion=$request->descripcion;
    
        if($carreras->save()){
            return response()->json($carreras);
        }
        return abort(402, "Error al Insertar");
    }



    public function update(Request $request)
    {  
        $carreras = Carrera::find($request->id);
        $carreras->nombre=$request->nombre; 
        $carreras->descripcion=$request->descripcion;
    
        if($carreras->save()){
            return response()->json($carreras);
        }
        return abort(402, "Error al actualizar");
    }


    public function getAll(Request $request)
    {
        if($request->id){
            $carreras=Carrera::find ($request->id);
            return response()->json($carreras);
        }
        $carreras=Carrera::all();
        return response()->json($carreras);
    }


    public function getOne($id)
    {
            $carrera=Carrera::find ($id);
            return response()->json($carrera);
    }


    public function delete(Request $request)
    {
        $carreras=DB::table('carreras')
        ->where('id','=',$request->id)
        ->delete();
            return response()->json('Eliminacion Exitosa!!');
    }
}
