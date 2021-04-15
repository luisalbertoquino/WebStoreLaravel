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
                <i class="fas fa-people-carry"></i>
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
                    <label for="nombreProducto" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Producto') }}</label>
                    <div class="col-md-8">
                        <input id="nombreProducto" type="text" class="form-control  @error('nombreProducto') is-invalid @enderror" name="nombreProducto"  value="{{ old('nombreProducto') }}" @if ($errors->has('nombreProducto')) autofocus @endif>
                    </div>
                </div>
                <!--descripcion producto-->
                <div class="form-group row">
                    <label for="detalleProducto" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>
                    <div class="col-md-8">
                        <textarea name="detalleProducto" class="form-control @error('detalleProducto') is-invalid @enderror" id="detalleProducto" cols="50" rows="3" @if ($errors->has('detalleProducto')) autofocus @endif>{{ old('detalleProducto')}}</textarea>
                    </div>
                    <br>
                </div>
                <!--stock producto-->
                <div class="form-group row">
                    <label for="stock" class="col-md-4 col-form-label text-md-right">{{ __('Stock') }}</label>
                    <div class="col-md-8">
                        <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" min="0" value="{{ old('stock') }}" @if ($errors->has('stock')) autofocus @endif>
                    </div>
                </div>
                
                <!--costo producto-->
                <div class="form-group row">
                    <label for="costo" class="col-md-4 col-form-label text-md-right">{{ __('Costo $') }}</label>
                    <div class="col-md-8">
                        <input id="costo" type="number" class="form-control @error('costo') is-invalid @enderror" name="costo" min="0" step = "any" oninput="alerta()" value="{{ old('costo') }}" @if ($errors->has('costo')) autofocus @endif>
                    </div>
                </div>
                
                <!--ganancia % producto-->
                <div class="form-group row">
                    <label for="porcentajeGanancia" class="col-md-4 col-form-label text-md-right">{{ __('Ganancia %') }}</label>
                    <div class="col-md-8">
                        <input id="porcentajeGanancia" type="text" readonly class="form-control @error('porcentajeGanancia') is-invalid @enderror" name="porcentajeGanancia" required value="{{ old('porcentajeGanancia') }}">
                    </div>
                </div>
                
                <!--ganancia producto-->
                <div class="form-group row">
                    <label for="valorVenta" class="col-md-4 col-form-label text-md-right">{{ __('Valor Venta $') }}</label>
                    <div class="col-md-8">
                        <input id="valorVenta" type="number" class="form-control @error('valorVenta') is-invalid @enderror" name="valorVenta" min="0" step = "any" oninput="alerta()" value="{{ old('valorVenta') }}" @if ($errors->has('valorVenta')) autofocus @endif >
                    </div>
                </div>
                
                <!--categoria-->
                <div class="form-group row">
                    <label for="idCategoria" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>
                    <div class="col-md-8">
                        <select name="idCategoria" id="idCategoria" class="form-control @error('idCategoria') is-invalid @enderror" @if ($errors->has('idCategoria')) autofocus @endif>
                            <option value="" selected disabled hidden>Choose here</option>
                            @foreach ($categorias as $categorias)
                            @if ($categorias->estado==1){
                            <option value={{$categorias->id}} {{ old('idCategoria') == $categorias->id ? 'selected' : '' }}>{{$categorias->categoria}}</option>
                             }
                           @endif
                            @endforeach
                        </select> 
                    </div> 
                </div> 
                
                <!--estado producto-->
                <div class="form-group row">
                    <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Seleccione Estado') }}</label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" @if ($errors->has('estado')) autofocus @endif>
                                <option value="" selected disabled hidden>Choose here</option>
                                <option value="1" >Activo</option>
                                <option value="0" >Inactivo</option>
                            </select>
                        </div>
                </div>
        
    
                <div class="form-group row mb-0">
                    <div class="col-md-12 offset-md-3">
                        <br>
                        <a href="/product" class="btn btn-danger">Regresar</a>
                        <button type="submit" class="btn btn-success" style="align-content: center;text-lign:center">
                            {{ __('Registrar') }}
                        </button> 
                    </div>
                </div>
            </form>
        
          </div>

    </div>
      
          </div>
          <script>
              function alerta() {
                var precioInicial=0;
                var precioFinal=0;
                var diferencia=0;
                var total=0;
                precioInicial=document.getElementById("costo").value;
                precioFinal=document.getElementById("valorVenta").value;
                diferencia=precioFinal-precioInicial;
                total=((precioFinal/precioInicial)*100)-100;
                if(precioInicial==0  ){
                    document.getElementById("porcentajeGanancia").setAttribute('value','');
                }else if(precioFinal==0){
                    document.getElementById("porcentajeGanancia").setAttribute('value','');
                }else{
                    document.getElementById("porcentajeGanancia").setAttribute('value',total.toFixed(4)+' % ( $'+diferencia+'.00)');
                }
                
            }
        </script>
      
      @endsection