<?php

namespace App\Http\Controllers;

use App\venta;
use App\User;
use App\producto;
use App\cliente;
use Illuminate\Http\Request;

class SaleController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $venta = venta::get();
        $producto = producto::get();
        $usuario = User::get();
        $cliente = cliente::get();
        return view('Sales.sale',['venta'=>$venta,'producto'=>$producto,'usuario'=>$usuario,'cliente'=>$cliente]);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto = producto::get();
        $cliente = cliente::get();
        $venta = venta::get(); 
        
        return view('Sales.newSale',['producto'=>$producto,'cliente'=>$cliente,'venta'=>$venta]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,producto $producto)
    {
        //dd($request);
        $data = request()->validate([
            'serialVenta'=>'required',
            'numeroVenta'=>'required',
            //'idProducto'=>'required',
            //'cantidadProducto'=>'required',
            'subtotal'=>'required',
            //'iva'=>'required',
            'total'=>'required',
            'idCliente'=>'required',
            'fechaEmision'=>'required',
            'idUsuario'=>'required',
            'estado'=>'required'
        ]);
        $cadena= request('idProducto');
        $cadena2= request('cantidadProducto');
        $cadena3= request('ivam');
        $array = explode(",", $cadena);
        $array2 = explode(",", $cadena2);
        $array3 = explode(",", $cadena3);
        $count = count($array);

        for($i = 0; $i < $count; $i++){
        $sale = new venta();
        //para la imagen del formulario $filename
        //para guardar el id del usuario actual como registro $user=auth()->user() y luego colocar $user->id despues de igual
        $sale->serialVenta = request('serialVenta');
        $sale->numeroVenta=request('numeroVenta');
        $sale->idProducto=$array[$i];
        $sale->cantidadProducto=$array2[$i]; //
        $sale->subtotal=request('subtotal');
        $sale->iva=$array3[$i];
        $sale->total=request('total');
        $sale->idCliente=request('idCliente');
        $sale->fechaEmision=request('fechaEmision');
        $sale->idUsuario=request('idUsuario');
        $sale->estadoBoolean=request('estado');
        $sale->save();
        $producto = producto::findOrFail($array[$i]);
        $producto->stock=$producto->stock-$array2[$i];
        $producto->save();
        //manipular el inventario
    }
    return redirect('/sale');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(venta $venta)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(venta $venta)
    {
        //
    }
}
