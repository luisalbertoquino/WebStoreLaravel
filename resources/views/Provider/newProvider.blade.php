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
            <a href="/provider">Proveedores</a>
          </li>
          <li class="breadcrumb-item active">Registro de Proveedor</li>
        </ol>
        <div class="card card-login mx-auto mt-2" style="border:1px solid #666"> 
            <div class="card-header" style="text-align: center">Añadir Proveedor&nbsp&nbsp<i class="fa fa-handshake-o" aria-hidden="true"></i></div>
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
    
            <form method="POST" action="/provider">
                @csrf
    
                
                
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Razon Social') }}</label>
                    <div class="col-md-6">
                        <input id="razonSocial" type="text" class="form-control" name="razonSocial"  autofocus="true">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Documento') }}</label>
                    <div class="col-md-6">
                        <select name="idDocumento" id="idDocumento" class="form-control">
                            @foreach ($documento as $documento)
                            @if ($documento->estado==1){
                            <option value={{$documento->id}}>{{$documento->tipoDocumento}}</option>
                             }
                           @endif
                            @endforeach
                        </select> 
                    </div>
                </div>
        
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('N° Documento') }}</label>
                    <div class="col-md-6">
                        <input id="numeroDocumento" type="text" class="form-control" name="numeroDocumento"  autofocus="true">
                    </div>
                </div>

    
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>
                    <div class="col-md-6">
                        <input id="direccion" type="text" class="form-control" name="direccion" >
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>
                    <div class="col-md-6">
                        <input id="telefono" type="text" class="form-control" name="telefono" >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" >
                    </div>
                </div>
    
                
    
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Seleccione estado') }}</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="estado" id="estado" class="form-control">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                </div>
        
                
     
    
                <div class="form-group row mb-0">
                    <div class="col-md-12 offset-md-4">
                        <br>
                        <button type="submit" class="btn btn-primary" style="align-content: center;text-lign:center">
                            {{ __('Registrar nuevo Proveedor') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
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