<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\User;
use App\Codigo;
use App\Peticion;
use Illuminate\Support\Facades\Hash;
use Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Arr;
use App\Mail\codigoAccesomail;
use App\Mail\permisoSolicitado;
use App\Events\socketValidate;

class usuarioController extends Controller
{
    public function LogIn(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $user=User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json("datos incorrectos",401);
        }

        $user2=User::where('email',$request->email)->first();
        
        $array = ['8L1O3A', '2W972Q', '32K05L', 'Z34Y8H', '5A67S3', 'AP201G', '1E39A2', 'WT32Q1', '30SL6D', '83NHFY', 'J80L5V', '4OSN81', 'UR820N', 
                '95UNO4', 'KY87TR','PAU020','M0Y4L0','RON571','U912OD','DM9283','90JTEL','ING5AK',
                'ING5AK', 'KORL71','073IYC','UVK984','JM4L1Z','78SJMD','F2TH03','04ZMH7','LWT28L','BLP27Y','R1B98H','HPC3M6','N56HW5','U4D3NI'];
        $code = Arr::random($array);

        if($user->tipo == '0')
        {
            $token=$user->createToken($request->email, ['user:user'])->plainTextToken;
            $user2->m2=1;
            $user2->m3=1;
            $user2->permiso=0;  
            $user2->save();
        }
        else if($user->tipo == '1'){
            $token=$user->createToken($request->email, ['user:user'])->plainTextToken;
            $user2->m2=0;
            $user2->m3=1;
            $user2->permiso=0;  
            $user2->save();

            DB::insert('insert into codigos (codigo) values (?)', [$code]);
            Mail::to($user->email)->send(new codigoAccesomail($code));
        }
        else{
            $token=$user->createToken($request->email, ['user:user'])->plainTextToken;
            $user2->m2=0;
            $user2->m3=0;
            $user2->permiso=1;  
            $user2->save();

            DB::insert('insert into codigos (codigo) values (?)', [$code]);
            Mail::to($user->email)->send(new codigoAccesomail($code));
            
        }
        return response()->json(["token"=>$token]);
    }



    public function event(){
        event(new socketValidate('Actualizacion'));
    }
    


    public function login2(Request $request)
    {
        if(!DB::table('codigos')->where('codigo','=',$request->codigo)->delete()){
            return response()->json('codigo incorrecto');
        }
        $user2=$request->user();
        if($user2->tipo == '1'){
            $user2->m2=1;
            $user2->m3=1;
            $user2->permiso=0;  
            $user2->save();
        }
        else if($user2->tipo == '2'){
            $user2->m2=1;
            $user2->m3=0;
            $user2->permiso=1;  
            $user2->save();
        }
        return response()->json('continua');
    }



    public function login3(Request $request)
    {
        $user2=$request->user();
        if($user2->tipo != 2){
            return response()->json('no tienes permiso');
        }
        $user2->m3=1; 
        $user2->permiso=1; 
        $user2->save();
        event(new socketValidate('Actualizacion'));
        return response()->json('continua');
    }


    public function permiso(Request $request) {
        if(!DB::table('codigos')->where('codigo','=',$request->codigo)->delete()){
            return response()->json('codigo incorrecto');
        }
        $user2=$request->user();
        $user2->permiso=1;
        $user2->save();
        return response()->json('continua');
    }



    public function generarCodigo(Request $request){
        //return response()->json($request->id);
        $user2=$request->user();
        if($user2->tipo != 2){
            return response()->json('no tienes permiso');
        }

        if(!$user=User::find ($request->id)){
            return response()->json('el usuario no existe');
        }

        $array = ['KFQ021','002OO3','012KKD','83YJE5','DYSYEM','99TPPS','111DDD',
        '88GGJJ','96L0PW','98FHND','09D6RH','LAO123','LOASBD','PAWLI1','90HSLA',
        '95MVL3','9MA1LW','09CMDS','BU2K88','09EUJF','6TRHDI','098HBD','JHGF53'];

        $code = Arr::random($array);

        DB::insert('insert into codigos (codigo) values (?)', [$code]);

        Mail::to($user->email)->send(new permisoSolicitado($code));
    }

    public function eliminarCodigo(Request $request){
        //return response()->json($request->id);
        DB::table('peticiones')->where('user','=',$request->id)->delete();
        return response()->json('eliminado');
    }


    public function solicitarPermiso(Request $request){
        //$user2=$request->user();
        if($request->tipo == 2){
            return response()->json('Los administradores no deben solicitar permisos');
        }

        if(DB::table('peticiones')->where('user','=',$request->id)->delete()){
            //echo ('eliminado');
        }
        DB::insert('insert into peticiones (user) values (?)', [$request->id]);
        return response()->json('Solicitud enviada');
        
    }


    public function getPeticiones(Request $request){
        $peticiones=DB::table('peticiones')
        ->join('users','peticiones.user','=','users.id')
        ->select('users.name', 'users.email', 'users.tipo','peticiones.user')->get();
        return response()->json(['Perfil'=>$peticiones],200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function LogOut(Request $request)
    {
        $user2=$request->user();
        $user2->m2=0;
        $user2->m3=0; 
        $user2->permiso=0;             
        $user2->save();
        return response()->json(["destroyed" => $request->user()->tokens()->delete()],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function Registro(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
            'name'=>'required',
        ]);
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->tipo='0'; 
        $user->m2=0;
        $user->m3=0;
        $user->ip='0.0.0.0';
        $user->permiso=0;


        if($user->save()){
            return response()->json($user);
        }
        return response()->json("Error al Insertar");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comentarioss  $comentarioss
     * @return \Illuminate\Http\Response
     */



    public function perfil(Request $request)
    {
         return response()->json(['Perfil'=>$request->user()],200);
    }





    public function perfilAndroid(Request $request)
    {
         return $request->user();
    }

    

    public function loginAndorid(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $user=User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json("datos incorrectos",401);
        }
            $token=$user->createToken($request->email, ['user:user'])->plainTextToken;
            $user->m2=1;
            $user->m3=0;
            $user->permiso=1;  
            $user->save();
        return response()->json(["token"=>$token]);
    }






    public function index(Request $request)
    {
        return response()->json(['Perfil'=>User::all()],200);
    }


    public function actualizar(Request $request)
    {
        $user=User::find ($request->id);
        $user->name= $request->name;
        $user->email= $request->email;  
        $user->tipo=$request->tipo;
        $user->ip=$request->ip;  
        if($user->save()){
        return response()->json(["Permiso Actualizado a"=>$user]);
        }
        return response()->json("Algo salio mal",400);  
    }


    public function drop(Request $request)
    {
        $Usuario=DB::table('users')
        ->where('id','=',$request->id)
        ->delete();
            return response()->json('Eliminacion Exitosa!!');
    }
    

    public function getOne(Request $request)
    {
        $usuario=DB::table('users')
        ->where('id','=',$request->id)
        ->get();
        return response($usuario);
    }


}
