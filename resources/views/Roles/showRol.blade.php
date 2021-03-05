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
            <a href="/config">Ajustes</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="/roles">Roles Registrados</a>
          </li>
          <li class="breadcrumb-item active">Mostrar Rol</li>
        </ol>
        <div class="card card-login mx-auto mt-2" style="border:1px solid #666"> 
            <div class="card-header" style="text-align: center">Informacion Rol&nbsp&nbsp<i class="fa fa-book" aria-hidden="true"></i></div>
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
                <h3>NOMBRE: {{ $rol['nombre'] }}</h3>
                <h4>SLUG  : {{ $rol['slug'] }}</h4>
            </div>
            <div class="card-body">
                <h5 class="card-title">Permissions</h5>
                <p style="text-align: center">
                    @if($rol->permissions->isNotEmpty())
                        @foreach($rol->permissions as $permission)
                          <span class="badge badge-success">
                              {{$permission->nombre}}
                          </span>
                        @endforeach
                      @endif
                </p>
            </div>
            <div class="card-footer">
                <a href="{{url()->previous()}}" class="btn btn-primary">Regresar</a>
            </div>

        </div>
    </div>
        
          </div>

    </div>

      
</div>

      
@endsection