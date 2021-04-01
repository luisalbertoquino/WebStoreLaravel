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
        <div class="card card-login mx-auto mt-1" style="border:1px solid #666"> 
            <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: italic;">INFORMACION PRODUCTO ID# {{$producto->id}}&nbsp&nbsp
                <i class="fa fa-eye" style="color:#0860b8  ;" aria-hidden="true"></i>
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

                @csrf
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Producto') }}</label>
                    <div class="col-md-8">
                        <input id="nombreProducto" type="text" class="form-control" name="nombreProducto" readonly autofocus="true" value="{{$producto->nombreProducto}}">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>
                    <div class="col-md-8">
                        <textarea name="detalleProducto" class="form-control" id="detalleProducto" cols="50" rows="3" readonly >{{$producto->detalleProducto}}</textarea>
                    </div>
                    <br>
                </div>
        
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Stock') }}</label>
                    <div class="col-md-8">
                        <input id="stock" type="number" class="form-control" name="stock" value="{{$producto->stock}}" readonly>
                    </div>
                </div>
       
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Costo $') }}</label>
                    <div class="col-md-8">
                        <input id="costo" type="number" class="form-control" name="costo" value="{{$producto->costo}}" readonly>
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Ganancia %') }}</label>
                    <div class="col-md-8">
                        <input id="porcentajeGanancia" type="text" class="form-control" name="porcentajeGanancia" value="{{$producto->porcentajeGanancia}}" readonly required>
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Valor Venta $') }}</label>
                    <div class="col-md-8">
                        <input id="valorVenta" type="number" class="form-control" name="valorVenta" value="{{$producto->valorVenta}}" readonly>
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>
                    <div class="col-md-8">
                        <select name="idCategoria" id="idCategoria" class="form-control" disabled>
                            @foreach ($categorias as $categorias)
                            @if ($categorias->estado==1)
                            <option selected="selected" value="{{$producto->category['id']}}">{{$producto->category['categoria']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Seleccione Estado') }}</label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <select name="estado" id="estado" value="{{$producto->estado}}" class="form-control" disabled>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                </div>
        
                
     
    
                <div class="form-group row mb-0">
                    <div class="col-md-12 offset-md-3">
                        <br>
                        <a href="{{url()->previous()}}" class="btn btn-danger">Regresar</a>
                    </div>
                </div>
        
          </div>

    </div>
            <!-- /.container-fluid -->
      
            <!-- Sticky Footer -->
      
          </div>
          <!-- /.content-wrapper -->
      
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