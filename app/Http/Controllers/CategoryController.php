<?php

namespace App\Http\Controllers;

use App\categoria;
use App\producto;

use Illuminate\Http\Request;

class CategoryController extends Controller
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


        $categorias = categoria::get();
        
        return view('Products.category',['categorias'=>$categorias]);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Products.newCategory');
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
            'categoria'=>'required|max:20',
            'descripcion'=>'required',
            'estado'=>'required'
        ]);

        $category = new categoria();
        //para la imagen del formulario $filename
        //para guardar el id del usuario actual como registro $user=auth()->user() y luego colocar $user->id despues de igual
        $category->categoria = request('categoria');
        $category->descripcion=request('descripcion');
        $category->estado=request('estado');

        $category->save();

        return redirect('/category');
    }
 
    /**
     * Display the specified resource.
     *
     * @param  \App\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(categoria $categoria)
    {
        $productos = producto::get();
        return view('Products.showCategory' , ['categoria'=>$categoria,'productos'=>$productos]);
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(categoria $categoria)
    {   
        
        $categoria = categoria::find($categoria->id); 
        
        return view('/Products/editCategory', ['categoria'=>$categoria]);
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, categoria $categoria)
    {

        $this->authorize('UpdateCategory',$categoria);
        $data = request()->validate([
            'categoria'=>'required|max:20',
            'descripcion'=>'required',
            'estado'=>'required'
        ]);
        $category = categoria::findOrFail($categoria->id);
        //para la imagen del formulario $filename
        //para guardar el id del usuario actual como registro $user=auth()->user() y luego colocar $user->id despues de igual
        $category->categoria = request('categoria');
        $category->descripcion=request('descripcion');
        $category->estado=request('estado');

        $category->save();

        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(categoria $categoria)
    {
        //find the category
        $categoria=categoria::find($categoria->id);

        //delete the category
        $categoria->delete();

        return redirect('/category');
    } 

    public function estado(Request $request, categoria $categoria){
        //dd($categoria->estado);
        
        $category = categoria::findOrFail($categoria->id);
        if($category->estado==0){
            $category->estado='1';
        }else{
            $category->estado='0';
        }
        $category->save();

        return redirect('/category');
    }
}
