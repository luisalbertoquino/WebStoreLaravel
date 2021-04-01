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
        <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: italic;">NUEVA CATEGORIA DE PRODUCTO&nbsp&nbsp
            <i class="fa fa-th-large" style="color: #0860b8  ;" aria-hidden="true"></i>
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
                        <textarea  id="descripcion"  type="descripcion" class="form-control" name="descripcion" value="{{ old('descripcion') }}" cols="18" rows="3"></textarea>
                    </div>
                </div>
    
                
    
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Seleccione Estado') }}</label>
                    <div class="col-md-6">
                
                        <div class="form-group">
                            <select name="estado" id="estado" class="form-control">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                </div>
                
    
                <div class="form-group row mb-0">
                    <br>
                <br>
                    <div class="col-md-12 offset-md-2">
                        <a href="{{url()->previous()}}" class="btn btn-danger">Regresar</a>&nbsp&nbsp&nbsp
                        <button type="submit" class="btn btn-primary">
                            {{ __('Añadir nueva categoria') }}&nbsp&nbsp<i class="fa fa-plus-square-o" aria-hidden="true"></i>  
                        </button>
                    </div>
                    
                </div>
            </form>
        
          </div>
        </div>
            </div>

            <script>
                var estado=document.getElementById('estado');
                if(estado=='1'){
                    document.getElementById('estado').options.item(0).selected = 'selected';
                }else{
                    document.getElementById('estado').options.item(1).selected = 'selected';
                }

            </script>
            <!-- /.container-fluid -->
      
            <!-- Sticky Footer -->
      
      
          <!-- /.content-wrapper -->
      
      @endsection