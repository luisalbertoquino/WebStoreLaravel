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
            <a href="/shopping">Compras</a>
          </li>
          <li class="breadcrumb-item active">Nueva Compra</li>
        </ol>
        <div class="card card-login2 mx-auto mt-2" style="border:1px solid #666"> 
            <div class="card-header" style="text-align: center">Registrar Nueva Compra&nbsp&nbsp<i class="fa fa-book" aria-hidden="true"></i></div>
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
    <form  action="/shopping">
        @csrf


                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Serie Comprobante') }}</label>
                    <div class="col-md-6">
                        <input id="serieComprobante" type="number" class="form-control" name="serieComprobante"  autofocus="true" value="{{$compra->serieComprobante}}" readonly>
                    </div>
                </div> 


                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Numero Comprobante') }}</label>
                    <div class="col-md-6">
                        <input id="numeroComprobante" type="number" class="form-control" name="numeroComprobante"  autofocus="true" value="{{$compra->numeroComprobante}}" readonly>
                    </div>
                </div>
        
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Emision') }}</label>
                    <div class="col-md-6">
                        <input id="fechaEmision" type="date" class="form-control" name="fechaEmision" value="{{$compra->fechaEmision}}" readonly>
                    </div>
                </div>
                <!--provedor-->
                    @if ($compra->proveedor['estado']==1)
                    <div class="form-group row">
                        <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Proveedor') }}</label>
                        <div class="col-md-6">
                            <input id="fechaEmision" type="text" class="form-control" name="fechaEmision" value="{{$compra->proveedor['razonSocial']}}" readonly>
                        </div>
                    </div>
                    @else
                    <div class="form-group row">
                        <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Proveedor') }}</label>
                        <div class="col-md-6">
                            <input id="fechaEmision" type="text" class="form-control" name="fechaEmision" value="Provedor Inactivo" readonly>
                        </div>
                    </div>
                    @endif


                    <!--Producto-->
                    @if ($compra->producto['estado']==1)
                    <div class="form-group row">
                        <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Producto') }}</label>
                        <div class="col-md-6">
                            <input id="fechaEmision" type="text" class="form-control" name="fechaEmision" value="{{$compra->producto['nombreProducto']}}" readonly>
                        </div>
                    </div>
                    @else
                    <div class="form-group row">
                        <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Producto') }}</label>
                        <div class="col-md-6">
                            <input id="fechaEmision" type="text" class="form-control" name="fechaEmision" value="AProducto Agotado o inactivo" readonly>
                        </div>
                    </div>
                    @endif


    
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Cantidad') }}</label>
                    <div class="col-md-6">
                        <input id="cantidad" type="number" class="form-control" name="cantidad" value="{{$compra->cantidad}}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Factura') }}</label>
                    <div class="col-md-6">
                        <input id="factura" type="text" class="form-control" name="factura" value="{{$compra->factura}}" readonly>
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Seleccione Estado') }}</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="estado" id="estado" class="form-control" value="{{$compra->estado}}" readonly>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                </div>
        
    
                <div class="form-group row mb-0">
                    <div class="col-md-12 offset-md-1">
                        <br>
                        <button type="submit" class="btn btn-primary" style="align-content: center;text-lign:center">
                            {{ __('Regresar') }}&nbsp&nbsp<i class="fa fa-backward" aria-hidden="true"></i>
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