<?php

namespace App\Http\Controllers;

use App\Rol;
use App\Permiso;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rol= Rol::orderBy('id','desc')->get();
        
        return view('Roles.allRoles', ['rol'=>$rol]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Roles.newRol');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $request->validate([
            'role_name' => 'required|max:255',
            'role_slug' => 'required|max:255'
        ]);



        //validate the rol fields
     

        $role = new Rol();
        $role->nombre = $request->role_name;
        $role->slug = $request->role_slug;
        $role->save();

        $listOfPermissions = explode(",",$request->hftest);
        //dd($listOfPermissions);
        foreach($listOfPermissions as $permission){
            $permiso = new Permiso();
            $permiso->nombre = $permission;
            $permiso->slug = strtolower(str_replace(" ","-",$permission));
            $permiso->save();
            $role->permissions()->attach($permiso->id);
            $role->save();
        }

        return redirect('/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function show(Rol $rol)
    {
        return view('Roles.showRol' , ['rol'=>$rol]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function edit(Rol $rol)
    {
        return view('Roles.editRoles', ['rol'=>$rol]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rol $rol)
    {
        $request->validate([
            'role_name' => 'required|max:255',
            'role_slug' => 'required|max:255'
        ]);
        //dd($request);
        $rol->nombre = request('role_name');
        $rol->slug = request('role_slug');
        $rol->save();
        
        $rol->permissions()->delete();
        $rol->permissions()->detach();
        
        

        $listOfPermissions = explode(",",$request->hftest);
        //dd($listOfPermissions);
        foreach($listOfPermissions as $permission){
            $permiso = new Permiso();
            $permiso->nombre = $permission;
            $permiso->slug = strtolower(str_replace(" ","-",$permission));
            $permiso->save();
            $rol->permissions()->attach($permiso->id);
            $rol->save();
        }

        return redirect('/roles');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rol $rol)
    {
        $rol->permissions()->delete();
        $rol->delete();
        $rol->permissions()->detach();
        //dd($rol);
        return redirect('/roles');
    }
}
