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
            <button type="submit" class="btn btn-primary" >
              {{ __('Nuevo Usuario del sistema') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
          </button>
            </form>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Usuarios Registrados</div>
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
                    <th>Ver +</th>
                    <th>estado</th>
                    <th>editar</th>
                
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Permisos</th>
                    <th>Ver +</th>
                    <th>estado</th>
                    <th>editar</th>
                  </tr>
                </tfoot>
                
                <tbody>
                  @foreach ($user as $users)
                  <!--Esconcer credenciales del administrador en la tabla de usuarios general-->
                  @if (!\Auth::user()->hasRole('administrador-main') && $users->hasRole('administrador-main')) @continue; @endif
                  <tr {{Auth::user()->id == $users->id  ? 'bgcolor=#ddd' : '' }}>
                    <td>{{$users->id}}</td>
                    <td>{{$users->nombre}} {{$users->apellido}}</td>
                    <td><textarea  style="border:0px" readonly value="{{$users->email}}" disabled  cols="15" rows="2">"{{$users->email}}"</textarea></td>
                    <td>
                      @if($users->roles->isNotEmpty())
                        @foreach($users->roles as $role)
                          <span class="badge badge-secondary">
                              {{$role->nombre}}
                          </span>
                        @endforeach
                      @endif
                    </td>


                    <td>
                      @if($users->permissions->isNotEmpty())
                        @foreach($users->permissions as $permission)
                          <span class="badge badge-secondary">
                              {{$permission->nombre}}
                          </span>
                        @endforeach
                      @endif
                    </td> 

                    <td style="text-align: center">
                      <a class="btn btn-info" href="/user/{{$users->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    </td>
                    <td  style="text-align: center;">
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
                      <!--editar--> 
                      <td style="text-align: center;">
                        <form action="/user/{{ $users['id'] }}/edit" method="GET">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </form>
                      </td>
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
              bLengthChange: false,
          });

      });
  </script>
@endsection