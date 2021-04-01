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
          <li class="breadcrumb-item active">Nuevo Producto</li>
        </ol>



        <div class="card card-login mx-auto mt-1" style="border:1px solid #666"> 
            <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: italic;">AÑADIR NUEVO PRODUCTO&nbsp&nbsp
                <i class="fa fa-archive" style="color: #964B00;" aria-hidden="true"></i>
            </div>
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
    
            <form method="POST" action="/product">
                @csrf
                <!--nombre producto-->
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Producto') }}</label>
                    <div class="col-md-8">
                        <input id="nombreProducto" type="text" class="form-control" name="nombreProducto"  autofocus="true">
                    </div>
                </div>
                <!--descripcion producto-->
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>
                    <div class="col-md-8">
                        <textarea name="detalleProducto" class="form-control" id="detalleProducto" cols="50" rows="3"></textarea>
                    </div>
                    <br>
                </div>
                <!--stock producto-->
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Stock') }}</label>
                    <div class="col-md-8">
                        <input id="stock" type="number" class="form-control" name="stock" min="0">
                    </div>
                </div>
                
                <!--costo producto-->
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Costo $') }}</label>
                    <div class="col-md-8">
                        <input id="costo" type="number" class="form-control" name="costo" min="0" step = "any" >
                    </div>
                </div>
                
                <!--ganancia % producto-->
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Ganancia %') }}</label>
                    <div class="col-md-8">
                        <input id="porcentajeGanancia" type="text" readonly class="form-control" name="porcentajeGanancia" required>
                    </div>
                </div>
                
                <!--ganancia producto-->
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Valor Venta $') }}</label>
                    <div class="col-md-8">
                        <input id="valorVenta" type="number" class="form-control" name="valorVenta" min="0" step = "any" >
                    </div>
                </div>
                
                <!--categoria-->
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>
                    <div class="col-md-8">
                        <select name="idCategoria" id="idCategoria" class="form-control">
                            @foreach ($categorias as $categorias)
                            @if ($categorias->estado==1){
                            <option value={{$categorias->id}}>{{$categorias->categoria}}</option>
                             }
                           @endif
                            @endforeach
                        </select> 
                    </div> 
                </div> 
                
                <!--estado producto-->
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Seleccione Estado') }}</label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <select name="estado" id="estado" class="form-control">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                </div>
        
    
                <div class="form-group row mb-0">
                    <div class="col-md-12 offset-md-3">
                        <br>
                        <a href="{{url()->previous()}}" class="btn btn-danger">Regresar</a>
                        <button type="submit" class="btn btn-primary" style="align-content: center;text-lign:center">
                            {{ __('Registrar') }}&nbsp&nbsp<i class="fa fa-plus-square-o" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
        
          </div>

    </div>
      
          </div>
          <script>

            $(document).ready(function() {
                document.getElementById("valorVenta").onchange = function(){alerta()};
            function alerta() {
                var precioInicial;
                var precioFinal;
                var diferencia;
                var total;
                precioInicial=document.getElementById("costo").value;
                precioFinal=document.getElementById("valorVenta").value;
                diferencia=precioFinal-precioInicial;
                total=((precioFinal/precioInicial)*100)-100;
                document.getElementById("porcentajeGanancia").setAttribute('value',total+' %')
            }

            });
        </script>
      
      @endsection