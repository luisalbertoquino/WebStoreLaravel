@extends('layouts.app')
@section('content')

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a>
          </li>
          <li class="breadcrumb-item active">Roles</li>
          <li class="breadcrumb-item active">Roles Creados</li>
          <form method="get" action="/roles/create" style="margin-left: auto;">
          <button type="submit" class="btn btn-primary" >
            {{ __('Registrar nuevo Rol en el Sistema') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
        </button>
          </form>
        </ol>
 
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            &nbsp&nbsp&nbsp&nbspRegistro de Roles</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th style="text-align: center;">Id</th>
                    <th style="text-align: center;">Role</th>
                    <th style="text-align: center;">Slug</th>
                    <th style="text-align: center;">Permissions</th>
                    <th style="text-align: center;">Tools</th>
                  </tr>
                </thead>
        
                <tbody>
                    @foreach($rol as $roles)
                    <tr>
                        <td>{{ $roles['id'] }}</td>
                        <td>{{ $roles['nombre'] }}</td>
                        <td>{{ $roles['slug'] }}</td>
                        <td>
                            @if($roles->permissions != null)
                              @foreach($roles->permissions as $permission)
                                <span class="badge badge-secondary">
                                  {{$permission->nombre}}
                                </span>
                              @endforeach
                            @endif
                        </td> 
                        <td style="text-align: center">
                            <a class="btn btn-warning" href="/roles/{{ $roles['id'] }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a class="btn btn-primary" href="/roles/{{ $roles['id'] }}/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a class="btn btn-danger"  data-toggle="modal" data-target="#deleteModal" data-postid="{{$roles['id']}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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


    </div>
    <!-- /.content-wrapper -->
  
    <!-- delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you shure you want to delete this?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
          </div>
          <div class="modal-body">Select "delete" If you realy want to delete this type document.</div>
          <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form method="POST" action="">
          @method('DELETE')
              @csrf
              <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Delete</a>
          </form>
         
          </div>
      </div>
      </div>
  </div>
    

  @section('js_role_page')
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var post_id = button.data('postid') 
            var modal = $(this)
            modal.find('.modal-footer #post_id').val(post_id);
            modal.find('form').attr('action','/roles/'+post_id);
        })
    </script>

<script>
    $(document).ready(function() {
        $('.js-example-theme-single').select2({theme:"classic"});
        $('#dataTable').DataTable({
            bLengthChange: false,
        });
  
    });
  </script>
@endsection

@endsection