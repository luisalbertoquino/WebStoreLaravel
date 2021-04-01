@extends('layouts.app')
@section('content')

    <div id="content-wrapper"> 

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a> 
          </li>
          <li class="breadcrumb-item">Ajustar variables comerciales</li>
        </ol>
      </div>

      <div class="card card-login mx-auto mt-5" style="border:1px solid #666"> 
        <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: italic;">ACTUALIZAR VARIABLES COMERCIALES&nbsp
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

           
            <form method="POST" action="/Bussiness/{{1}}">
                @method('PATCH')
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Pagina Web actual') }}</label>
                    <div class="col-md-8">
                        <input id="paginaWeb" type="text" class="form-control" name="paginaWeb" value="{{ $config['paginaWeb'] }}" >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Iva Establecido') }}</label>
                    <div class="col-md-4">
                      <input id="ivaActual" type="number"class="form-control" name="ivaActual" min="1" max="100" value="{{ $config['ivaActual'] }}">
                      </div>

                      <div class="col-md-1">
                        <i class="fa fa-percent" aria-hidden="true"></i>
                      </div>
                </div>

                <div class="form-group row">
                  <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Impuestos Adicionales') }}</label>
                  <div class="col-md-4">
                    <input id="impuestos" type="number" class="form-control" name="impuestos" min="0" max="100" value="{{ $config['impuestos'] }}" >
                  </div>

                  <div class="col-md-1">
                    <i class="fa fa-percent" aria-hidden="true"></i>
                  </div>
              </div>

              <div class="form-group row">
                <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Otros Aspectos comerciales') }}</label>
                <div class="col-md-8">
                  <textarea name="otros" class="form-control" id="otros" cols="30" rows="5" >{{ $config['otros'] }}</textarea>
                 
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


    </div>


@endsection