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
            <a href="/roles">Todos los Roles</a>
          </li>
          <li class="breadcrumb-item active">editar rol {{ $rol['nombre'] }}</li>
        </ol>
        <div class="card card-login mx-auto mt-2" style="border:1px solid #666"> 
            <div class="card-header" style="text-align: center">Editar Rol&nbsp&nbsp<i class="fa fa-book" aria-hidden="true"></i></div>
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
      <form method="POST" action="/roles/{{$rol->id}}">
        @csrf
        @method('PATCH')
        <div class="form-group row">
            <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Rol') }}</label>
            <div class="col-md-6">
                <input id="role_name" type="text" class="form-control" name="role_name" placeholder="Role Name" autofocus="true" value="{{$rol->nombre}}">
            </div>
        </div>

        <div class="form-group row">
          <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Slug') }}</label>
          <div class="col-md-6">
              <input id="role_slug" type="text" class="form-control" name="role_slug" placeholder="Role Slug" autofocus="true" value="{{$rol->slug}}">
          </div>
      </div>

      <div class="form-group row">
        <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Permisos Anteriores') }}</label>
        <div class="col-md-6">
            <input type="text" id="role_permisions" data-role="tagsinput"  class="form-control" name="role_permisions"  value="@foreach($rol->permissions as $permission)
              {{$permission->nombre.  ","}}
            @endforeach">
        </div>
    </div>

    <div class="form-group row">
      <h5>Nota: Los Permisos Anteriores seran Eliminados, debe indicar nuevos permisos</h5>
  </div>
  <label for="descripcion" class="col-md-8 col-form-label text-md-right">{{ __('Add New Permissions') }}</label>

    <div class="form-group row">
      <div class="col-md-6">
        <select class="js-example-responsive" multiple data-live-search="true" id="role_permisions2" name="role_permisions2" style="width: 250px" onchange="fock.call(this, event)">
          <option>Crear 1</option>
          <option>Eliminar 2</option>
          <option>Actualizar 3</option>
          <option>Ver 4</option>
      </select>
      </div>
  </div>

  <input id="hftest" type="text" class="form-control" name="hftest" autofocus="true" readonly hidden>

        <div class="form-group row mb-0">
            <div class="col-md-12 offset-md-4">
                <br>
                <button type="submit" class="btn btn-primary" style="align-content: center;text-lign:center">
                    {{ __('Actualizar Rol') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </form>


    <script>
      function fock(event){
          var values = $('#role_permisions2').val();
          document.getElementById("hftest").setAttribute("value",values);
  
      }
  
  
      $(document).ready(function() {
          $('.js-example-responsive').select2({theme:"classic"});
          $('#role_name').keyup(function(e){
            var str = $('#role_name').val();
            var niu = str.replace(/\W+(?!$)/g, '-').toLowerCase();
            $('#role_slug').val(niu);
            $('#role_slug').attr('placeholder',niu);
          })
      });
  
      
    </script>
      @section('css_role_page')
      <link rel="stylesheet" href="/css/bootstrap-tagsinput.css">
      @endsection
  
      @section('js_role_page')
        <script src="/js/bootstrap-tagsinput.js"></script>
      @endsection
    </div>
        
          </div>

    </div>
            <!-- /.container-fluid -->
      
            <!-- Sticky Footer -->
      
          </div>
          <!-- /.content-wrapper -->
      
      @endsection