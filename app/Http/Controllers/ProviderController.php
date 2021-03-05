<?php

namespace App\Http\Controllers;

use App\proveedor;
use App\documento;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    { 
        $this->middleware('auth');
    }
    public function index()
    {
        $proveedor = proveedor::get();
        return view('Provider.provider',['proveedor'=>$proveedor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documento = documento::get();
      
        return view('Provider.newProvider',['documento'=>$documento]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'razonSocial'=>'required',
            'idDocumento'=>'required',
            'numeroDocumento'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'email'=>'required',
            'estado'=>'required'
        ]);

        $proveedor = new proveedor();
        //para la imagen del formulario $filename
        //para guardar el id del usuario actual como registro $user=auth()->user() y luego colocar $user->id despues de igual
        $proveedor->razonSocial = request('razonSocial');
        $proveedor->idDocumento=request('idDocumento');
        $proveedor->numeroDocumento=request('numeroDocumento');
        $proveedor->direccion=request('direccion');
        $proveedor->telefono=request('telefono');
        $proveedor->email=request('email');
        $proveedor->estado=request('estado');

        $proveedor->save();

        return redirect('/provider');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(proveedor $proveedor)
    {
        
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(proveedor $proveedor)
    {
        $proveedor = proveedor::find($proveedor->id);
        $documento = documento::get();
        
        return view('/Provider/editProvider', ['proveedor'=>$proveedor,'documento'=>$documento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, proveedor $proveedor)
    {
        $data = request()->validate([
            'razonSocial'=>'required',
            'idDocumento'=>'required',
            'numeroDocumento'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'email'=>'required',
            'estado'=>'required'
        ]);

        $proveedor = proveedor::findOrFail($proveedor->id);
        //para la imagen del formulario $filename
        //para guardar el id del usuario actual como registro $user=auth()->user() y luego colocar $user->id despues de igual
        $proveedor->razonSocial = request('razonSocial');
        $proveedor->idDocumento=request('idDocumento');
        $proveedor->numeroDocumento=request('numeroDocumento');
        $proveedor->direccion=request('direccion');
        $proveedor->telefono=request('telefono');
        $proveedor->email=request('email');
        $proveedor->estado=request('estado');

        $proveedor->save();

        return redirect('/provider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(proveedor $proveedor)
    {
        //
    }

    public function estado(Request $request, proveedor $proveedor){

        $proveedor = proveedor::findOrFail($proveedor->id);
        if($proveedor->estado==0){
            $proveedor->estado='1';
        }else{
            $proveedor->estado='0';
        }
        $proveedor->save();

        return redirect('/provider');
    }
}
