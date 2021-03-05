<?php

namespace App\Http\Controllers;

use App\documento;
use Illuminate\Http\Request;

class DocumentController extends Controller
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
        $documento = documento::get();
        return view('Document.document',['documento'=>$documento]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documento = documento::get();
      
        return view('Document.newDocument',['documento'=>$documento]);
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
            'tipoDocumento'=>'required',
            'estado'=>'required'
        ]);

        $documento = new documento();
        //para la imagen del formulario $filename
        //para guardar el id del usuario actual como registro $user=auth()->user() y luego colocar $user->id despues de igual
        $documento->tipoDocumento = request('tipoDocumento');
        $documento->estado=request('estado');

        $documento->save();

        return redirect('/document');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit(documento $documento)
    {
        $documento = documento::find($documento->id);
        return view('Document.editDocument', ['documento'=>$documento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, documento $documento)
    {
        $data = request()->validate([
            'tipoDocumento'=>'required',
            'estado'=>'required'
        ]);

        $documento = documento::findOrFail($documento->id);
        //para la imagen del formulario $filename
        //para guardar el id del usuario actual como registro $user=auth()->user() y luego colocar $user->id despues de igual
        $documento->tipoDocumento = request('tipoDocumento');
        $documento->estado=request('estado');

        $documento->save();

        return redirect('/document');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy(documento $documento)
    {
        //find the category

        //delete the category
        $documento->delete();

        return redirect('/document');
    }

    public function estado(Request $request, documento $documento){

        $documento = documento::findOrFail($documento->id);
        if($documento->estado==0){
            $documento->estado='1';
        }else{
            $documento->estado='0';
        }
        $documento->save();

        return redirect('/document');
    }
}
