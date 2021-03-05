<?php

namespace App\Http\Controllers;

use App\compra;
use App\proveedor;
use App\producto;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $compra = compra::get();
        $proveedor = proveedor::get();
        $producto = producto::get();
        return view('Shopping.shopping',['compra'=>$compra,'proveedor'=>$proveedor,'producto'=>$producto]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedor = proveedor::get();
        $producto = producto::get();
        $compra = compra::get();
      
        return view('Shopping.newShopping',['compra'=>$compra,'proveedor'=>$proveedor,'producto'=>$producto]);
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
            'serieComprobante'=>'required',
            'numeroComprobante'=>'required',
            'fechaEmision'=>'required',
            'idProveedor'=>'required',
            //'idProducto'=>'required',
            //'cantidad'=>'required',
            'factura'=>'required',
            'estado'=>'required'
        ]);

        $cadena= request('idProducto');
        $cadena2= request('cantidadProducto');
        $array = explode(",", $cadena);
        $array2 = explode(",", $cadena2);
        $count = count($array);

        for($i = 0; $i < $count; $i++){
        $compra = new compra();
        //para la imagen del formulario $filename
        //para guardar el id del usuario actual como registro $user=auth()->user() y luego colocar $user->id despues de igual
        $compra->serieComprobante = request('serieComprobante');
        $compra->numeroComprobante=request('numeroComprobante');
        $compra->factura=request('factura');
        $compra->idProducto=$array[$i];
        $compra->cantidad=$array2[$i]; //
        //$compra->fechaEmision=request('subtotal');
        //$compra->iva=request('iva'); 
        //$compra->total=request('total');
        $compra->idProveedor=request('idProveedor');
        $compra->fechaEmision=request('fechaEmision');
        //$compra->idUsuario=request('idUsuario');
        $compra->estado=request('estado');
        $compra->save();
        $producto = producto::findOrFail($array[$i]);
        $producto->stock=$producto->stock+$array2[$i];
        $producto->save();
        //manipular el inventario
    }
    return redirect('/shopping');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(compra $compra)
    {
        $compra = compra::find($compra->id);
        $proveedor = proveedor::get();
        $producto = producto::get(); 
        
        return view('/Shopping/viewShopping', ['compra'=>$compra,'proveedor'=>$proveedor,'producto'=>$producto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(compra $compra)
    {
        //
    }
}
