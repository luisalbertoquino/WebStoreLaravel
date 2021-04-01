@extends('layouts.app')
@section('content')

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a>
          </li>
          <li class="breadcrumb-item active">Ajustes</li>
          <li class="breadcrumb-item active">Documentos Registrados</li>
          <form method="get" action="/document/create" style="margin-left: auto;">
            @if(Auth::user()->permissions->contains('slug', 'createdocument')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
          <button type="submit" class="btn btn-primary" >
            {{ __('Registrar nuevo tipo de documento al Sistema') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
        </button>
            @endif
          </form>
        </ol>
 
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            &nbsp&nbsp&nbsp&nbspRegistro de documentos</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th style="text-align: center;">Id</th>
                    <th style="text-align: center;">Tipo Documento</th>
                    @if(Auth::user()->permissions->contains('slug', 'downdocument')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th style="text-align: center;">Estado</th>
                    @endif
                    @if(Auth::user()->permissions->contains('slug', 'updatedocument')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th style="text-align: center;">Editar</th>
                    @endif
                  </tr>
                </thead>
                
                <tbody>
                  @foreach ($documento as $documento)
                  <tr>
                    <td style="text-align: center;">{{$documento->id}}</td>
                    <td style="text-align: center;">{{$documento->tipoDocumento}}</td>

                    @if(Auth::user()->permissions->contains('slug', 'downdocument')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <td  style="text-align: center;">
                    <!--cambiar estado-->
                    <form action="/document/estado/{{$documento->id}}" method="POST">
                      @method('PATCH')
                      {{csrf_field()}}
                      @if ($documento->estado==0)
                      <button class="btn btn-danger" type="submit"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                      @else
                      <button class="btn btn-success" type="submit" ><i class="fa fa-refresh" aria-hidden="true"></i></button>
                      @endif
                    </form>
                    </td>
                    @endif

                    @if(Auth::user()->permissions->contains('slug', 'updatedocument')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <!--editar-->
                    <td style="text-align: center;">
                      <a class="btn btn-primary" href="/document/{{$documento->id}}/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                      <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#deleteModal" data-postid="{{$documento->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
          @if ($documento->id=!false)
          <form method="POST" action="/document/{{$documento->id}}">
          @method('DELETE')
              @csrf
            
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
            modal.find('form').attr('action','/document/' + post_id);
        });

        

    </script>

@endsection

<script>
  $(document).ready(function() {
      $('.js-example-theme-single').select2({theme:"classic"});
      $('#dataTable').DataTable({
         
      });

  });
</script>

@endsection