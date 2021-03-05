@extends('layouts.app')
@section('content')

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a>
          </li>
          <li class="breadcrumb-item active">Categorias</li>
          <form method="get" action="/category/create" style="margin-left: auto;">
          <button type="submit" class="btn btn-primary" >
            {{ __('Nueva Categoria') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
        </button>
          </form>
        </ol>
 
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            &nbsp&nbsp&nbsp&nbspRegistro de Categorias</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th style="text-align: center;">Id</th>
                    <th style="text-align: center;">Categoria</th>
                    <th style="text-align: center;">Descripcion</th>
                    <th style="text-align: center;">Estado</th>
                    <th style="text-align: center;">Edit</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th style="text-align: center;">Id</th>
                    <th style="text-align: center;">Categoria</th>
                    <th style="text-align: center;">Descripcion</th>
                    <th style="text-align: center;">Estado</th>
                    <th style="text-align: center;">Edit</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($categorias as $categorias)
                  <tr> 
                    <td style="text-align: center;">{{$categorias->id}}</td>
                    <td><textarea  style="border:0px" readonly value="{{$categorias->categoria}}" disabled  cols="20" rows="4">"{{$categorias->categoria}}"</textarea></td>
                    <td><textarea  style="border:0px" readonly value="{{$categorias->descripcion}}" disabled  cols="30" rows="4">"{{$categorias->descripcion}}"</textarea></td>
                    <td  style="text-align: center;">
                    <!--cambiar estado-->
                    <form action="/category/estado/{{$categorias->id}}" method="POST">
                      @method('PATCH')
                      {{csrf_field()}}
                      @if ($categorias->estado==0)
                      <button class="btn btn-danger" type="submit"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                      @else
                      <button class="btn btn-success" type="submit" ><i class="fa fa-refresh" aria-hidden="true"></i></button>
                      @endif
                    </form>
                    </td>
                    <!--editar-->
                    <td style="text-align: center;">
                      <a class="btn btn-primary" href="/category/{{$categorias->id}}/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                      <a class="btn btn-danger" href="/" data-toggle="modal" data-target="#deleteModal" data-postid="{{$categorias->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
          <div class="modal-body">Select "delete" If you realy want to delete this category.</div>
          <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          @if ($categorias->id=!false)
          <form method="POST" action="/category/{{$categorias->id}}">
            @method('DELETE')
                @csrf
                <input type="hidden" id="post_id" name="post_id" value="">
                <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Delete</a>
            </form>
          @endif
          
          </div>
      </div>
      </div>
  </div>

  @section('js_post_page')
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var post_id = button.data('postid') 
            var modal = $(this)
            modal.find('.modal-footer #post_id').val(post_id);
            modal.find('form').attr('action','/category/' + post_id);
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