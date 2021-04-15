<?php

namespace App\Http\Controllers;

use App\venta;
use App\User;
use App\producto;
use App\cliente;
use App\documento;
use App\negocio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class SaleController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        if(\Auth::user()->hasRole('administrador-main') || \Auth::user()->hasPermission('adminsales')){
            //$venta = venta::distinct()->get(['serialVenta']);;
            /*$venta= venta::select('id','serialVenta', 'numeroVenta', 'idProducto', 'cantidadProducto', 'subtotal', 'iva', 'total', 'idCliente', 'fechaEmision', 'idUsuario', 'estadoBoolean')
            ->groupBy('numeroVenta')
            ->get();
            */
           // $venta= venta::select('id','serialVenta', 'numeroVenta', 'idProducto', 'cantidadProducto', 'subtotal', 'iva', 'total', 'idCliente', 'fechaEmision', 'idUsuario', 'estadoBoolean')->distinct()->get();
           // $venta = venta::select('id','serialVenta', 'numeroVenta', 'idProducto', 'cantidadProducto', 'subtotal', 'iva', 'total', 'idCliente', 'fechaEmision', 'idUsuario', 'estadoBoolean')->distinct()->get();
          $venta = venta::get();
           // dd($venta);
        }else{
            
            $venta = venta::where('idUsuario', \Auth::user()->id)->orderBy('id','desc')
            ->get();
        }
        
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
        $config= negocio::find(1); 
        
        return view('Sales.newSale',['producto'=>$producto,'cliente'=>$cliente,'venta'=>$venta,'config'=>$config]);
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
            'subtotal'=>'required',
            'ivaAcum'=>'required',
            'total'=>'required',
            'idCliente'=>'required',
            'fechaEmision'=>'required',
            'idUsuario'=>'required',
            'estado'=>'required',
            'impuesto'=>'required',
            'totalDescontado'=>'required',
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
        $sale = new venta();
        //para la imagen del formulario $filename
        //para guardar el id del usuario actual como registro $user=auth()->user() y luego colocar $user->id despues de igual
        $sale->serialVenta = request('serialVenta');
        $sale->numeroVenta=request('numeroVenta');
        $sale->idProducto=$array[$i]; //
        $sale->cantidadProducto=$array2[$i]; //
        $sale->subtotal=request('subtotal');
        $sale->iva=$array3[$i];
        $sale->ivaAcum=request('ivaAcum');
        $sale->descuentoPorcentaje=$array4[$i];
        $sale->impuesto=request('impuesto');
        $sale->totalDescontado=request('totalDescontado');
        $sale->total=request('total');
        $sale->idCliente=request('idCliente');
        $sale->fechaEmision=request('fechaEmision');
        $sale->idUsuario=request('idUsuario');
        $sale->estado=request('estado');
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
        $ventaOp = venta::find($venta);
        $usuario = User::get();
        $cliente = cliente::get();
        $ventaFull = venta::get();
        $documento= documento::get();
        $config= negocio::find(1); 
        return view('Sales.showSale', ['venta'=>$venta,'ventaFull'=>$ventaFull,'usuario'=>$usuario,'cliente'=>$cliente,'documento'=>$documento,'config'=>$config]);
    }

    public function show2(venta $venta)
    {   
        $ventaOp = venta::find($venta);
        $usuario = User::get();
        $cliente = cliente::get();
        $ventaFull = venta::get();
        $documento= documento::get();
        $config= negocio::find(1);
        $image = base64_encode(file_get_contents(public_path($config->logo)));
        $image2 = base64_encode(file_get_contents(public_path($config->nombreLogo)));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('Pdf.reporteVenta', ['venta'=>$venta,'ventaFull'=>$ventaFull,'usuario'=>$usuario,'cliente'=>$cliente,'documento'=>$documento,'config'=>$config,'image'=>$image,'image2'=>$image2]);
        return $pdf->stream();
        //return view('Pdf.reporteVenta', ['venta'=>$venta,'ventaFull'=>$ventaFull,'usuario'=>$usuario,'cliente'=>$cliente,'documento'=>$documento,'config'=>$config,'image'=>$image,'image2'=>$image2]);
    }

    public function show3()
    {   
        $usuario = User::get(); 
        $cliente = cliente::get();
        $venta = venta::get();
        $documento= documento::get();
        $config= negocio::find(1);
        $image = base64_encode(file_get_contents(public_path($config->logo)));
        $image2 = base64_encode(file_get_contents(public_path($config->nombreLogo)));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('Pdf.reporteVentas', ['venta'=>$venta,'usuario'=>$usuario,'cliente'=>$cliente,'documento'=>$documento,'config'=>$config,'image'=>$image,'image2'=>$image2]);
        //$pdf = PDF::loadView('Pdf.reporteVentas', ['venta'=>$venta,'ventaFull'=>$ventaFull,'usuario'=>$usuario,'cliente'=>$cliente,'documento'=>$documento,'config'=>$config,'image'=>$image,'image2'=>$image2]);
        //return view('Pdf.reporteVentas', ['venta'=>$venta,'usuario'=>$usuario,'cliente'=>$cliente,'documento'=>$documento,'config'=>$config,'image'=>$image,'image2'=>$image2]);
        return $pdf->stream();
    }


    public function show4(venta $venta)
    {   
        $ventaOp = venta::find($venta);
        $usuario = User::get();
        $cliente = cliente::get();
        $ventaFull = venta::get();
        $documento= documento::get();
        $config= negocio::find(1);
        $image = base64_encode(file_get_contents(public_path($config->logo)));
        $image2 = base64_encode(file_get_contents(public_path($config->nombreLogo)));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('Pdf.reporteVenta', ['venta'=>$venta,'ventaFull'=>$ventaFull,'usuario'=>$usuario,'cliente'=>$cliente,'documento'=>$documento,'config'=>$config,'image'=>$image,'image2'=>$image2]);
        //return $pdf->stream();
        return view('Print.imprimirVenta', ['venta'=>$venta,'ventaFull'=>$ventaFull,'usuario'=>$usuario,'cliente'=>$cliente,'documento'=>$documento,'config'=>$config,'image'=>$image,'image2'=>$image2]);
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

    public function estado(Request $request, venta $venta){

        $sale = venta::findOrFail($venta->id);
        if($sale->estado==0){
            $sale->estado='1';
        }else{
            $sale->estado='0';
        }
        $sale->save();

        return redirect('/sale');
    }
}
