<?php

namespace App\Http\Controllers;

use App\User;
use App\usuario;
use App\Rol;
use App\Permiso;
use App\documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        $user = User::get();
        return view('users.allUser',['user'=>$user]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        

        if($request->ajax()){
            $roles = Rol::where('id', $request->role_id)->first();
            $permissions = $roles->permissions;
            return $permissions;
        }

        $documento = documento::get();

        $roles = Rol::all();

        
        //dd($roles);
      
        return view('users.newUser',['documento'=>$documento,'roles'=>$roles]);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $user = request()->validate([
            'nombre'=>'required|max:50',
            'apellido'=>'required|max:50',
            'idDocumento'=>'required',
            'numeroDocumento'=>'required',
            'email'=>'required',
            'telefono'=>'required',
            'direccion'=>'required',
            'password'=>'required',
            'estado'=>'required'
        ]);

        $usuario = new User();
        //para la imagen del formulario $filename
        //para guardar el id del usuario actual como registro $user=auth()->user() y luego colocar $user->id despues de igual
        $usuario->nombre = request('nombre');
        $usuario->apellido=request('apellido');
        $usuario->idDocumento=request('idDocumento');
        $usuario->numeroDocumento=request('numeroDocumento');
        $usuario->email=request('email');
        $usuario->telefono=request('telefono');
        $usuario->direccion=request('direccion');
        $usuario->password=bcrypt($request->password);
        $usuario->estado=request('estado');
        $usuario->save();

        if($request->role != null){
            $usuario->roles()->attach($request->role);
            $usuario->save();
        }

        if($request->permissions != null){            
            foreach ($request->permissions as $permission) {
                $usuario->permissions()->attach($permission);
                $usuario->save();
            }
        }

        return redirect('/user');
      
        }
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.showUser' , ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = User::find($user->id);
        $piola = $user->id;
        $documento = documento::get();
        $roles= Rol::get();
        $userRol = $user->roles->first();
        if($userRol !=null){
            $rolePermission = $userRol->permissions;
        }else{
            $rolePermission = null;
        }
        
        $userPermissions = $user->permissions;
        

        return view('users.editUser', [
            'piola'=>$piola,
            'user'=>$user,
            'documento'=>$documento,
            'roles'=>$roles,
            'userRol'=>$userRol,
            'rolePermissions'=>$rolePermission,
            'userPermissions'=>$userPermissions
            
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $piola)
    {   
        $user = request()->validate([
            'nombre'=>'required|max:50',
            'apellido'=>'required|max:50',
            'idDocumento'=>'required',
            'numeroDocumento'=>'required',
            'email'=>'required',
            'telefono'=>'required',
            'direccion'=>'required',
            'password'=>'required',
            'estado'=>'required',
            'password'=> 'required'
        ]);
        $usuario = User::findOrFail($piola->id);

        //para la imagen del formulario $filename
        //para guardar el id del usuario actual como registro $user=auth()->user() y luego colocar $user->id despues de igual
        $usuario->nombre = request('nombre');
        $usuario->apellido=request('apellido');
        $usuario->idDocumento=request('idDocumento');
        $usuario->numeroDocumento=request('numeroDocumento');
        $usuario->email=request('email');
        $usuario->telefono=request('telefono');
        $usuario->direccion=request('direccion');
        $usuario->password=bcrypt($request->password);
        $usuario->estado=request('estado');
        $usuario->save();
        

        $usuario->roles()->detach();
        $usuario->permissions()->detach();

        if($request->role !=null){
            $usuario->roles()->attach($request->role);
            $usuario->save();
        }
        
        if($request->permissions !=null){
            foreach($request->permissions as $permission){
            $usuario->permissions()->attach($permission);
            $usuario->save();
            }
        }

        return redirect('/user');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(usuario $user)
    {
        //
    }


    public function estado(Request $request, User $user){

        $user = User::findOrFail($user->id);
        if($user->estado==0){
            $user->estado='1';
        }else{
            $user->estado='0';
        }
        $user->save();

        return redirect('/user');
    }
}
