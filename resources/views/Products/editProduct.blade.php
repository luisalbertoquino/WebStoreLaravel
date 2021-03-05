@extends('layouts.app')
@section('content')

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="/product">Productos</a>
          </li>
          <li class="breadcrumb-item active">Modificar Producto</li>
        </ol>
        <div class="card card-login2 mx-auto mt-2" style="border:1px solid #666"> 
            <div class="card-header" style="text-align: center">Modificar Producto&nbsp&nbsp<i class="fa fa-book" aria-hidden="true"></i></div>
        <div class="card-body">

            <!--mensajes de error-->
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul >
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>  
    </div>
    @endif
    
            <form method="POST" action="/product/{{$producto->id}}">
                @method('PATCH')
                @csrf
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Producto') }}</label>
                    <div class="col-md-6">
                        <input id="nombreProducto" type="text" class="form-control" name="nombreProducto"  autofocus="true" value="{{$producto->nombreProducto}}">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion Producto') }}</label>
                    <div class="col-md-6">
                        <textarea name="detalleProducto" class="form-control" id="detalleProducto" cols="50" rows="3" >{{$producto->detalleProducto}}</textarea>
                    </div>
                    <br>
                </div>
        
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Stock') }}</label>
                    <div class="col-md-6">
                        <input id="stock" type="number" class="form-control" name="stock" value="{{$producto->stock}}">
                    </div>
                </div>
       
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Costo $') }}</label>
                    <div class="col-md-6">
                        <input id="costo" type="number" class="form-control" name="costo" value="{{$producto->costo}}" >
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('% ganancia') }}</label>
                    <div class="col-md-6">
                        <input id="porcentajeGanancia" type="number" class="form-control" name="porcentajeGanancia" value="{{$producto->porcentajeGanancia}}">
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Valor Venta $') }}</label>
                    <div class="col-md-6">
                        <input id="valorVenta" type="number" class="form-control" name="valorVenta" value="{{$producto->valorVenta}}">
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>
                    <div class="col-md-6">
                        <select name="idCategoria" id="idCategoria" class="form-control">
                            @foreach ($categorias as $categorias)
                            @if ($categorias->estado==1){
                            <option selected="selected" value="{{$producto->category['id']}}">categoria actual: {{$producto->category['categoria']}}</option>
                            <div class="dropdown-divider"></div>
                            
                            <option value={{$categorias->id}}>{{$categorias->categoria}}</option>
                            }
                            @endif
                            
                            @endforeach
                        </select>
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Seleccione Estado') }}</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Seleccione estado</label>
                            <select name="estado" id="estado" value="{{$producto->estado}}">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                </div>
        
                
     
    
                <div class="form-group row mb-0">
                    <div class="col-md-12 offset-md-1">
                        <br>
                        <button type="submit" class="btn btn-primary" style="align-content: center;text-lign:center">
                            {{ __('Editar') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
        
          </div>

    </div>
            <!-- /.container-fluid -->
      
            <!-- Sticky Footer -->
      
          </div>
          <!-- /.content-wrapper -->
      
      @endsection