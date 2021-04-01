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
            <a href="/category">Categorias</a>
          </li>
          <li class="breadcrumb-item active">Ver Categoria</li>
        </ol>
        <div class="card card-login mx-auto mt-2" style="border:1px solid #666"> 
            <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: italic;">INFORMACION CATEGORIA ID# {{$categoria->id}}&nbsp&nbsp
                <i class="fa fa-eye" style="color:#0860b8  ;" aria-hidden="true"></i>
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

    <div class="container">

        <div class="card">
            <div class="card-header">
                <h3>NOMBRE: {{ $categoria->categoria }}</h3>
            </div>
            <div class="card-body">
                <p style="text-align: center">
                <h4>Descripcion:</h4>
                <h5> {{ $categoria->descripcion }}</h5>
                </p>

                <p style="text-align: center">
                    <h4>Productos Asociados:</h4>
                    @foreach ($productos as $productos)
                        @if($productos->idCategoria==$categoria->id)
                            <h5>{{$productos->nombreProducto}}</h5>
                        @endif
                    @endforeach
                    </p>
            </div>
            <div class="card-footer">
                <a href="{{url()->previous()}}" class="btn btn-primary">Regresar</a>
            </div>
            <br>
            

        </div>
    </div>
        
          </div>

    </div>

      
</div>

      
@endsection