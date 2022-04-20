<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Video;
use App\User;
use Illuminate\Support\Facades\Hash;
use Log;

class videoController extends Controller
{
    public function nuevo(Request $request)
    {   $request->validate([
            'nombre'=>'required',
            'descripcion'=>'required',
            'url'=>'required',
            'image'=>'required',
            'categoria'=>'required',
            'tipo'=>'required',
        ]);


        $user2=$request->user();
        if($user2->permiso != 1){
            return response()->json('no tienes permiso');
        }

        if($user2->tipo != 2){
            $user2->permiso=0;
            $user2->save();
        }

        $video = new Video();
        $video->nombre=$request->nombre; 
        $video->descripcion=$request->descripcion;
        $video->url=$request->url;
        $video->image=$request->image;
        $video->categoria=$request->categoria;   
        $video->tipo=$request->tipo;
        $video->likes='0';
        $video->dislikes='0';
        $video->estatus='1';
    
        if($video->save()){
            return response()->json($video);
        }
        return abort(402, "Error al Insertar");
    }

    public function actualizar(Request $request)
    {   $request->validate([
            'id'=>'required'
        ]);

        $user2=$request->user();
        if($user2->permiso != 1){
            return response()->json('no tienes permiso');
        }

        if($user2->tipo != 2){
            $user2->permiso=0;
            $user2->save();
        }

        $video = Video::find($request->id);
        $video->nombre=$request->nombre; 
        $video->descripcion=$request->descripcion;
        $video->url=$request->url;
        $video->categoria=$request->categoria;   
        $video->tipo=$request->tipo;
        
    
        if($video->save()){
            return response()->json("Cambios guardados");
        }
        return abort(402, "Error al actualizar");
    }
    
    public function getVideos(Request $request)
    {
        if($request->id){
            $video=Video::find ($request->id);
            return response()->json($video);
        }
        $videos=Video::all();
        return response()->json($videos);
    }


    public function carrera(Request $request)
    {
        $videos=DB::table('videos')
        ->where('videos.tipo','=',$request->tipo)
        ->select('*')
        ->get();
        return ($videos);
    }


    public function getVideo($id)
    {
            $video=Video::find ($id);
            return response()->json($video);
    }

    public function video(Request $request){
        $video=Video::find($request->id);

        return response()->json($video);
    }

    public function getVideosCategoria(Request $request)
    {
        $videos=DB::table('videos')
        ->where('videos.categoria','=',$request->categoria)
        ->select('*')
        ->get();
        return ($videos);
    }

    public function likeVideo(Request $request)
    {
        $video=Video::find ($request->id);  
        $video->likes= $video->likes + 1;
        if($video->save()){  
            return response()->json(["Like"=>$video]);   
        }
        return response()->json(null,400); 
    }

    public function disLikeVideo(Request $request)
    {
        $video=Video::find ($request->id);  
        $video->dislikes= $video->dislikes + 1;
        if($video->save())
        { 
            return response()->json(["Like"=>$video]);   
        }
        return response()->json(null,400); 
    }

    public function buscador(Request $request)
    {
        $videos = DB::table('videos')->where('videos.nombre','LIKE','%'.$request->nombre.'%')->get(); 
        return response()->json($videos);
    }
    


    public function drop(Request $request)
    {
        $user2=$request->user();
        if($user2->permiso != 1){
            return response()->json('no tienes permiso');
        }

        if($user2->tipo != 2){
            $user2->permiso=0;
            $user2->save();
        }

        $video=DB::table('videos')
        ->where('id','=',$request->id)
        ->delete();
            return response()->json('Eliminacion Exitosa!!');
    }
}
