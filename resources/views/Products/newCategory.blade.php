@extends('layouts.app')
@section('content')

   

      <div class="container-fluid" >

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a>
          </li>
          <li class="breadcrumb-item" >
            <a href="/category">Categorias</a>
          </li>
          <li class="breadcrumb-item active">Nueva Categoria</li>
        </ol>
        <div class="card card-login mx-auto mt-5" style="border:1px solid #666"> 
        <div class="card-header" style="text-align: center">Nueva categoria de producto&nbsp&nbsp<i class="fa fa-book" aria-hidden="true"></i></div>
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
            <form method="POST" action="/category">
                {{csrf_field()}}
                
                <div class="form-group row">
                    <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Categoria') }}</label>
                    <div class="col-md-6">
                        <input id="categoria" type="categoria" class="form-control" name="categoria" value="{{ old('categoria') }}" >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion Categoria') }}</label>
                    <div class="col-md-6">
                        <input id="descripcion" type="descripcion" class="form-control" name="descripcion" value="{{ old('descripcion') }}" >
                    </div>
                </div>
    
                
    
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Seleccione Estado') }}</label>
                    <div class="col-md-6">
                
                        <div class="form-group">
                            <label>Seleccione estado</label>
                            <select name="estado" id="estado" ">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                </div>
                <br>
                
    
                <div class="form-group row mb-0">
                    <div class="col-md-12 offset-md-6">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Añadir nueva categoria') }}
                        </button>
                    </div>
                </div>
            </form>
        
          </div>
        </div>
            </div>

            <script>
                var estado=document.getElementById('estado');
                console.log(estado);
                if(estado=='1'){
                    document.getElementById('estado')=1;
                }else{
                    document.getElementById('estado')=0
                }

            </script>
            <!-- /.container-fluid -->
      
            <!-- Sticky Footer -->
      
      
          <!-- /.content-wrapper -->
      
      @endsection