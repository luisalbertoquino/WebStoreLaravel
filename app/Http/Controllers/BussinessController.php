<?php

namespace App\Http\Controllers;

use App\negocio;
use Illuminate\Http\Request;

class BussinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //variables comerciales
    public function index()
    {
        $config= negocio::find(1);
        
        return view('config.config',['config'=>$config]); 
    }

    //variables de la empresa
    public function index2()
    {
        $config= negocio::find(1);
        return view('config.business',['config'=>$config]); 
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nombreEmpresa'=>'required',
            'razonSocial'=>'required',
            'nit'=>'required',
            'telefono'=>'required',
            'email'=>'required',
            'paginaWeb'=>'required',
            'ivaActual'=>'required',
            'impuestos'=>'required',
            'otros'=>'required',
            'logo'=>'required',
            'nombreLogo'=>'required',

            ]);
            
            $config= negocio::get();

            $config->nombreEmpresa= request('nombreEmpresa');
            $config->razonSocial= request('razonSocial');
            $config->nit= request('nit');
            $config->telefono= request('telefono');
            $config->email= request('email');
            $config->paginaWeb= request('paginaWeb');
            $config->ivaActual= request('ivaActual');
            $config->impuestos= request('impuestos');
            $config->otros= request('otros');
            $config->logo= request('logo');
            $config->nombreLogo= request('nombreLogo');
            $config->save();

            return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function show(negocio $negocio)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function edit(negocio $negocio)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, negocio $negocio)
    {
        $data = request()->validate([
            'paginaWeb'=>'required',
            'ivaActual'=>'required',
            'impuestos'=>'required',
            'otros'=>'required',
            ]);
            $configs = negocio::find(1);
            
            $configs->paginaWeb= request('paginaWeb');
            $configs->ivaActual= request('ivaActual');
            $configs->impuestos= request('impuestos');
            $configs->otros= request('otros');
            $configs->save();

            return redirect('/home');
    }



    public function update2(Request $request, negocio $negocio)
    {
        $data = request()->validate([
            'nombreEmpresa'=>'required',
            'razonSocial'=>'required',
            'nit'=>'required',
            'telefono'=>'required',
            'email'=>'required',
            'paginaWeb'=>'required',


            ]);

            
            $configs = negocio::find(1);
            if(request('logo')!=null){
                $configs->logo=$request->file('logo')->store('public');
            }elseif(request('nombreLogo')!=null){
                $configs->nombreLogo=$request->file('nombreLogo')->store('public');
            }

            $configs->nombreEmpresa= request('nombreEmpresa');
            $configs->razonSocial= request('razonSocial');
            $configs->nit= request('nit');
            $configs->telefono= request('telefono');
            $configs->email= request('email');
            $configs->paginaWeb= request('paginaWeb');
            
            $configs->save();
            
            return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function destroy(negocio $negocio)
    {
        //
    }
}
