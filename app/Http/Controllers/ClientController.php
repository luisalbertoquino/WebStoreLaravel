<?php

namespace App\Http\Controllers;

use App\cliente;
use App\documento;
use Illuminate\Http\Request;
 
class ClientController extends Controller
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
        $cliente = cliente::get();
        return view('Clients.client',['clientes'=>$cliente]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documento = documento::get();
      
        return view('Clients.newClient',['documento'=>$documento]);
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
            'nombre'=>'required',
            'apellido'=>'required',
            'idDocumento'=>'required',
            'numeroDocumento'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'email'=>'required',
            'estado'=>'required'
        ]);

        $client = new cliente();
        //para la imagen del formulario $filename
        //para guardar el id del usuario actual como registro $user=auth()->user() y luego colocar $user->id despues de igual
        $client->nombre = request('nombre');
        $client->apellido=request('apellido');
        $client->idDocumento=request('idDocumento');
        $client->numeroDocumento=request('numeroDocumento');
        $client->direccion=request('direccion');
        $client->telefono=request('telefono');
        $client->email=request('email');
        $client->estado=request('estado');

        $client->save();

        return redirect('/client');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(cliente $cliente)
    {
        $cliente = cliente::find($cliente->id);
        $documento = documento::get();
        
        return view('/Clients/editClient', ['cliente'=>$cliente,'documento'=>$documento]);
    }

    /** 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cliente $cliente)
    {
        $data = request()->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'idDocumento'=>'required',
            'numeroDocumento'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'email'=>'required',
            'estado'=>'required'
        ]);

        $client = cliente::findOrFail($cliente->id);
        //para la imagen del formulario $filename
        //para guardar el id del usuario actual como registro $user=auth()->user() y luego colocar $user->id despues de igual
        $client->nombre = request('nombre');
        $client->apellido=request('apellido');
        $client->idDocumento=request('idDocumento');
        $client->numeroDocumento=request('numeroDocumento');
        $client->direccion=request('direccion');
        $client->telefono=request('telefono');
        $client->email=request('email');
        $client->estado=request('estado');

        $client->save();

        return redirect('/client');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(cliente $cliente)
    {
        //
    }

    public function estado(Request $request, cliente $cliente){

        $cliente = cliente::findOrFail($cliente->id);
        if($cliente->estado==0){
            $cliente->estado='1';
        }else{
            $cliente->estado='0';
        }
        $cliente->save();

        return redirect('/client');
    }
}
