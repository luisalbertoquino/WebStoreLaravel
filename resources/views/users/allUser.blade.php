@extends('layouts.app')
@section('content')
 
    <div id="content-wrapper"> 

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a>
          </li>
          <li class="breadcrumb-item active">Usuarios</li>
          <form method="get" action="/user/create" style="margin-left: auto;">
            @if(Auth::user()->permissions->contains('slug', 'createuser')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
            <button type="submit" class="btn btn-primary" >
              {{ __('Nuevo Usuario del sistema') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
          </button>
          @endif
            </form>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: bold;">
            <i class="fas fa-table" style="color: #c2cfdd  ;"></i>&nbsp&nbsp
            USUARIOS REGISTRADOS
            <span style="float: left">
              <a href="/sale3" class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
          </span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Permisos</th>
                    <th>Ver</th>
                    <th>estado</th>
                    <th>editar</th>
                
                  </tr>
                </thead>
                
                <tbody>
                  @foreach ($user as $users)
                  <!--Esconcer credenciales del administrador en la tabla de usuarios general-->
                  @if (!\Auth::user()->hasRole('administrador-main') && $users->hasRole('administrador-main')) @continue; @endif
                  <tr {{Auth::user()->id == $users->id  ? 'bgcolor=#ddd' : '' }}>
                    <td tyle="width:20px;">{{$users->id}}</td>
                    <td tyle="width:150px;">{{$users->nombre}} {{$users->apellido}}</td>
                    <td tyle="width:100px;">{{$users->email}}</td>
                    <td tyle="width:100px;">
                      @if($users->roles->isNotEmpty())
                        @foreach($users->roles as $role)
                          <span class="badge badge-secondary">
                              {{$role->nombre}}
                          </span>
                        @endforeach
                      @endif
                    </td>


                    <td tyle="width:150px;">
                      @if($users->permissions->isNotEmpty())
                        @foreach($users->permissions as $permission)
                          <span class="badge badge-secondary">
                              {{$permission->nombre}}
                          </span>
                        @endforeach
                      @endif
                    </td> 
                    <!--ver usuario-->
                    @if(Auth::user()->permissions->contains('slug', 'viewuser')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <td style="text-align: center;width:30px;">
                      <a class="btn btn-info" href="/user/{{$users->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    </td>
                    @endif

                    @if(Auth::user()->permissions->contains('slug', 'downuser')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <td  style="text-align: center;width:30px;">
                      <!--cambiar estado-->
                      <form action="/user/estado/{{$users->id}}" method="POST">
                        @method('PATCH')
                      {{csrf_field()}}
                        @if ($users->estado==0)
                        <button class="btn btn-danger" type="submit"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                        @else
                        <button class="btn btn-success" type="submit" ><i class="fa fa-refresh" aria-hidden="true"></i></button>
                        @endif
                      </form>
                      </td> 
                      @endif

                      @if(Auth::user()->permissions->contains('slug', 'updateuser')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                      <!--editar--> 
                      <td style="text-align: center;width:30px;">
                        <form action="/user/{{ $users['id'] }}/edit" method="GET">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </form>
                      </td>
                      @endif
                  </tr>
                  @endforeach
                
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted" style="text-align: center">Updated <input type="datetime" style="text-align: center" name="fecha"  readonly="true" value="<?php echo date("Y-m-d\TH-i");?>"></div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->

    </div>
    <!-- /.content-wrapper -->

    <script>
      $(document).ready(function() {
          $('.js-example-theme-single').select2({theme:"classic"});
          $('#dataTable').DataTable({
              
          });

      });
  </script>
@endsection