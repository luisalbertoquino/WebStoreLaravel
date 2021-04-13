<?php

namespace App\Http\Controllers;

use App\venta;
use App\producto;
use App\categoria;
use App\User; 
use App\cliente;
use Illuminate\Http\Request;

class ReportesController extends Controller
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

        $productos = producto::get();
        $categoria = categoria::get();
        $venta = venta::get();
        $cliente = cliente::get();
        return view('reports.reportProductMore',['productos'=>$productos,'categoria'=>$categoria,'venta'=>$venta,'cliente'=>$cliente]);
    }

    public function index2()
    {
        $venta = venta::get();
        $producto = producto::get();
        $usuario = User::get();
        $cliente = cliente::get();
        return view('reports.reportSale',['venta'=>$venta,'producto'=>$producto,'usuario'=>$usuario,'cliente'=>$cliente]);
    }

    public function index3()
    {   
        $venta = venta::get();
        $productos = producto::get();
        $categoria = categoria::get();
        $cliente = cliente::get();
        return view('reports.reportProductLess',['productos'=>$productos,'categoria'=>$categoria,'venta'=>$venta,'cliente'=>$cliente]);
    }


    function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      if($request->from_date != '' && $request->to_date != '')
      {
       $data = DB::table('sale')
         ->whereBetween('date', array($request->from_date, $request->to_date))
         ->get();
      }
      else
      {
       $data = DB::table('post')->orderBy('date', 'desc')->get();
      }
      echo json_encode($data);
     }
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
        // 
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
