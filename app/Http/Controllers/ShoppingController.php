<?php

namespace App\Http\Controllers;

use App\compra;
use App\proveedor;
use App\producto;
use App\negocio;
use Illuminate\Http\Request;

class ShoppingController extends Controller
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
        $config= negocio::find(1); 
      
        return view('Shopping.newShopping',['compra'=>$compra,'proveedor'=>$proveedor,'producto'=>$producto,'config'=>$config]);
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
            'subtotal'=>'required', //
            'ivaAcum'=>'required', //
            'total'=>'required', //
            'fechaEmision'=>'required',
            'idProveedor'=>'required',
            'factura'=>'required',
            'estado'=>'required',
            'impuesto'=>'required', //
            'totalDescontado'=>'required', //
        ]);

        $cadena= request('idProducto');
        $cadena2= request('cantidadProducto');
        $cadena3= request('iva');
        $cadena4= request('descuentoPorcentaje');
        $array = explode(",", $cadena);
        $array2 = explode(",", $cadena2);
        $array3 = explode(",", $cadena3);
        $array4 =explode(",", $cadena4);
        $count = count($array);

        for($i = 0; $i < $count; $i++){
        $compra = new compra();
       
        $compra->serieComprobante = request('serieComprobante');
        $compra->numeroComprobante=request('numeroComprobante');
        $compra->idProducto=$array[$i]; //
        $compra->cantidad=$array2[$i]; //
        $compra->factura=request('factura');
        $compra->subtotal=request('subtotal');
        $compra->iva=$array3[$i];
        $compra->ivaAcum=request('ivaAcum');
        $compra->descuentoPorcentaje=$array4[$i];
        $compra->impuesto=request('impuesto');
        $compra->totalDescontado=request('totalDescontado');
        $compra->total=request('total');
        $compra->idProveedor=request('idProveedor');
        $compra->fechaEmision=request('fechaEmision');
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
        $compraOp = venta::find($compra);
        $usuario = User::get();
        $proveedor = proveedor::get();
        $producto = producto::get();
        $compra = compra::get();
        $config= negocio::find(1); 
      
        return view('Shopping.showShopping',['compra'=>$compra,'proveedor'=>$proveedor,'producto'=>$producto,'config'=>$config,'usuario'=>$usuario]);
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
