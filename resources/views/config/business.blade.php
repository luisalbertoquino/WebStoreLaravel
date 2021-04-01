@extends('layouts.app')
@section('content')

    <div id="content-wrapper"> 

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a> 
          </li>
          <li class="breadcrumb-item">Ajustar Opciones Del negocio</li>
        </ol>
      </div>


      <div class="card card-login mx-auto mt-5" style="border:1px solid #666"> 
        <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: italic;">PERSONALIZAR MARCA NEGOCIO&nbsp
            <i class="fa fa-pencil" style="color: #0860b8  ;" aria-hidden="true"></i>
            <span style="float: left">
              <a href="/home" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
          </span>
        </div>
        <div class="card-body">
            <br>
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
            <form method="POST" action="/Bussiness2/{{1}}" enctype="multipart/form-data">
                @method('PATCH')
                {{csrf_field()}}
                    
                <div class="form-group row">
                  <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Empresa') }}</label>
                  <div class="col-md-8">
                      <input id="nombreEmpresa" type="text" class="form-control" name="nombreEmpresa" value="{{ $config['nombreEmpresa'] }}" >
                  </div>
                </div>
                  <div class="form-group row">
                    <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Razon Social') }}</label>
                    <div class="col-md-8">
                        <input id="razonSocial" type="text" class="form-control" name="razonSocial" value="{{ $config['razonSocial'] }}" >
                    </div>
                </div>
                  <div class="form-group row">
                    <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Nit') }}</label>
                    <div class="col-md-8">
                        <input id="nit" type="text" class="form-control" name="nit" value="{{ $config['nit'] }}" >
                    </div>
                </div>
                  <div class="form-group row">
                    <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>
                    <div class="col-md-8">
                        <input id="telefono" type="text" class="form-control" name="telefono" value="{{ $config['telefono'] }}" >
                    </div>
                </div>
                  <div class="form-group row">
                    <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                    <div class="col-md-8">
                        <input id="email" type="text" class="form-control" name="email" value="{{ $config['email'] }}" >
                    </div>
                </div>
                  <div class="form-group row">
                      <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Pagina Web actual') }}</label>
                      <div class="col-md-8">
                          <input id="paginaWeb" type="text" class="form-control" name="paginaWeb" value="{{ $config['paginaWeb'] }}" >
                      </div>
                  </div>

              <div class="form-group row">
                <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Imagen Logo') }}</label>
                <div class="col-md-14">
                    <input id="logo" type="file" class="form-control" name="logo" value="{{ $config['logo'] }}" >
                </div>
            </div>

            <div class="form-group row">
              <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Imagen Nombre Logo') }}</label>
              <div class="col-md-14">
                  <input id="nombreLogo" type="file" class="form-control" name="nombreLogo"  value="{{ $config['nombreLogo'] }}" >
              </div>
          </div>
                <br>
                
                <div class="form-group row mb-1">
                    <div class="col-md-12 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Registrar Parametros') }}&nbsp&nbsp<i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
          </div>
        </div>


    </div>


@endsection