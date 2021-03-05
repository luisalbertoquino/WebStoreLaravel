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
            <a href="/client">Clientes</a>
          </li>
          <li class="breadcrumb-item active">Editar Cliente</li>
        </ol>
        <div class="card card-login mx-auto mt-2" style="border:1px solid #666"> 
            <div class="card-header" style="text-align: center">Modificar Cliente Seleccionado&nbsp&nbsp<i class="fa fa-handshake-o" aria-hidden="true"></i></div>
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
    
            <form method="POST" action="/client/{{$cliente->id}}">
                @method('PATCH')
                @csrf 
    
                <div class="form-group row">
                    <label for="descripcion" class="col-md-5 col-form-label text-md-left">{{ __('Nombre Cliente') }}</label>
                    <div class="col-md-8">
                        <input id="nombre" type="text" class="form-control" name="nombre"  autofocus="true" value="{{$cliente->nombre}}">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="descripcion" class="col-md-5 col-form-label text-md-left">{{ __('Apellido Cliente') }}</label>
                    <div class="col-md-8">
                        <input name="apellido" class="form-control" id="apellido" value="{{$cliente->apellido}}" >
                    </div>
                    <br>
                </div>
        
                <div class="form-group row">
                    <label for="descripcion" class="col-md-5 col-form-label text-md-left">{{ __('Tipo Documento') }}</label>
                    <div class="col-md-8">
                        <select name="idDocumento" id="idDocumento" class="form-control" value="{{$cliente->idDocumento}}">
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
                    <label for="descripcion" class="col-md-5 col-form-label text-md-left">{{ __('N° Documento') }}</label>
                    <div class="col-md-8">
                        <input id="numeroDocumento" type="text" class="form-control" name="numeroDocumento" value="{{$cliente->numeroDocumento}}">
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="descripcion" class="col-md-5 col-form-label text-md-left">{{ __('Direccion') }}</label>
                    <div class="col-md-8">
                        <input id="direccion" type="text" class="form-control" name="direccion" value="{{$cliente->direccion}}">
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="descripcion" class="col-md-5 col-form-label text-md-left">{{ __('Telefono') }}</label>
                    <div class="col-md-8">
                        <input id="telefono" type="text" class="form-control" name="telefono" value="{{$cliente->telefono}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="descripcion" class="col-md-5 col-form-label text-md-left">{{ __('E-mail') }}</label>
                    <div class="col-md-8">
                        <input id="email" type="email" class="form-control" name="email" value="{{$cliente->email}}" >
                    </div>
                </div>
    
                
    
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-5 col-form-label text-md-right">{{ __('Seleccione Estado') }}</label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <select name="estado" id="estado" class="form-control" value="{{$cliente->estado}}">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                </div>
        
                
     
    
                <div class="form-group row mb-0">
                    <div class="col-md-12 offset-md-4">
                        <br>
                        <button type="submit" class="btn btn-primary" style="align-content: center;text-lign:center">
                            {{ __('Modificar Cliente') }}&nbsp&nbsp<i class="fa fa-wrench" aria-hidden="true"></i>
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