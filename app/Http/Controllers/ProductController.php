<?php

namespace App\Http\Controllers;

use App\producto; 
use App\categoria;
use Illuminate\Http\Request;
use DB;
use App\negocio;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade as PDF;


class ProductController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = producto::get();
        $categorias = categoria::get();
        return view('Products.product',['productos'=>$productos,'categorias'=>$categorias]);
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
        $categorias = categoria::get();
      
        return view('Products.newProduct',['categorias'=>$categorias]);
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
            'nombreProducto'=>'required',
            'detalleProducto'=>'required',
            'stock'=>'required',
            'costo'=>'required',
            'porcentajeGanancia'=>'required',
            'valorVenta'=>'required',
            'idCategoria'=>'required',
            'estado'=>'required'
        ]);

        $product = new producto();
        //para la imagen del formulario $filename
        //para guardar el id del usuario actual como registro $user=auth()->user() y luego colocar $user->id despues de igual
        $product->nombreProducto = request('nombreProducto');
        $product->detalleProducto=request('detalleProducto');
        $product->stock=request('stock');
        $product->costo=request('costo');
        $product->porcentajeGanancia=request('porcentajeGanancia');
        $product->valorVenta=request('valorVenta');
        $product->idCategoria=request('idCategoria');
        $product->estado=request('estado');

        $product->save();

        return redirect('/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(producto $productos)
    {
        $categorias = producto::get();
        //
        return view('Products.showProduct', ['producto'=>$productos,'categorias'=>$categorias]);
    }
    
    public function show2()
    {   
        $productos = producto::get();
        $categorias = categoria::get();
        $config= negocio::find(1); 
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('Pdf.reporteProductos', ['producto'=>$productos,'categorias'=>$categorias,'config'=>$config]);
        //$pdf = PDF::loadView('Pdf.reporteVenta', ['venta'=>$venta,'ventaFull'=>$ventaFull,'usuario'=>$usuario,'cliente'=>$cliente,'documento'=>$documento,'config'=>$config]);
        return $pdf->download();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(producto $productos) 
    {   
        $productos = producto::find($productos->id);
        $categorias = categoria::get(); 
        
        return view('/Products/editProduct', ['producto'=>$productos,'categorias'=>$categorias]);
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, producto $producto)
    {   
        
        
        /*if (Gate::allows('isAdmin')) {
            dd('el usauario es admin');
        }else{
            dd('el usuairo no es admin');
        }*/
        $data = request()->validate([
            'nombreProducto'=>'required',
            'detalleProducto'=>'required',
            'stock'=>'required',
            'costo'=>'required',
            'porcentajeGanancia'=>'required',
            'valorVenta'=>'required',
            'idCategoria'=>'required',
            'estado'=>'required'
        ]);
 
        $product = producto::findOrFail($producto->id);
        $product->nombreProducto = request('nombreProducto');
        $product->detalleProducto=request('detalleProducto');
        $product->stock=request('stock');
        $product->costo=request('costo');
        $product->porcentajeGanancia=request('porcentajeGanancia');
        $product->valorVenta=request('valorVenta');
        $product->idCategoria=request('idCategoria');
        $product->estado=request('estado');

        $product->save();

        return redirect('/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(producto $producto)
    {
        //
    }

    public function estado(Request $request, producto $productos){

        $product = producto::findOrFail($productos->id);
        if($product->estado==0){
            $product->estado='1';
        }else{
            $product->estado='0';
        }
        $product->save();

        return redirect('/product');
    }
} 
