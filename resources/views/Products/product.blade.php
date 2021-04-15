@extends('layouts.app')
@section('content')

    <div id="content-wrapper"> 

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a>
          </li>
          <li class="breadcrumb-item active">Productos</li>
          <form method="get" action="/product/create" style="margin-left: auto;">
            @if(Auth::user()->permissions->contains('slug', 'createproduct')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
            <button type="submit" class="btn btn-primary" >
              {{ __('Nuevo Producto') }}&nbsp&nbsp<i class="fas fa-cart-plus"></i>
          </button>
          @endif 
            </form>
        </ol> 

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: bold;">
            <i class="fas fa-box-open"></i>&nbsp&nbsp
            PRODUCTOS REGISTRADOS
            <span style="float: right">
              <a title="Imprimir registros de tabla" href="/product2" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
          </span>
        </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th>id</th>
                    <th>Producto</th>
                    <th>Descripcion</th>
                    <th>Stock</th>
                    <th>Valor_Venta</th>
                    <th>Categoria</th>
                    
                    @if(Auth::user()->permissions->contains('slug', 'viewproduct')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th style="text-align: center;">Ver</th>
                    @endif
                    @if(Auth::user()->permissions->contains('slug', 'updateproduct')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th style="text-align: center;">Edit</th>
                    @endif
                    @if(Auth::user()->permissions->contains('slug', 'downproduct')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th style="text-align: center;">Estado</th>
                    @endif
                    @if(Auth::user()->roles->first()->nombre=='Administrador Main')
                    <th style="text-align: center;">Delete</th>
                    @endif
                  </tr>
                </thead>


                <tbody>
                  @foreach ($productos as $productos)
                  @if($productos->category['estado']==1)
                  <tr>
                    
                      <td style="width:30px;text-align: center;">{{$productos->id}}</td>
                      <td style="width:70px;" class="a">{{$productos->nombreProducto}}</td>
                      <td style="width:120px;" class="a">{{$productos->detalleProducto}}</td>
                      <td style="width:30px;">{{$productos->stock}} c/u</td>
                      <td style="width:30px;text-align: center;">${{$productos->valorVenta}}</td>
                      <td style="width:30px;">
                        <!--Categoria-->
                        @if ($productos->category['estado']==1)
                        {{$productos->category['categoria']}}
                        @else
                        Categoria no definida
                        @endif
                      </td> 

                      <!--ver-->
                      @if(Auth::user()->permissions->contains('slug', 'viewproduct')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                      <td style="width:70px; text-align:center">
                        <a class="btn btn-warning" style="color:#ffff" href="/product/{{$productos->id}}"><i class="fas fa-eye"></i></a>
                      </td>
                      @endif 

                      <!--editar-->
                      @if(Auth::user()->permissions->contains('slug', 'updateproduct')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                      <td style="text-align: center;width:50px">
                        <form action="/product/{{ $productos['id'] }}/edit" method="GET">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i></button>
                        </form>
                      </td>
                      @endif

                      <!--Estado-->
                      @if(Auth::user()->permissions->contains('slug', 'updatecategory')==true || Auth::user()->roles->first()->nombre=='Administrador Main')
                      <td style="text-align: center;width:50px">
                        <form action="/product/estado/{{$productos->id}}" method="POST">
                          @method('PATCH')
                        {{csrf_field()}}
                          @if ($productos->estado==0)
                            @if(Auth::user()->roles->first()->nombre=='Administrador Main')
                            <button class="btn btn-danger" type="submit"><i class="fas fa-minus-circle"></i></button>
                            @else
                            <button class="btn btn-danger" disabled type="submit"><i class="fas fa-minus-circle"></i></button>
                            @endif
                          @else
                          <button class="btn btn-success" type="submit"><i class="fas fa-minus-circle"></i></button>
                          @endif
                        </form>
                      </td>
                      @endif 

                    <!--eliminar-->
                    @if(Auth::user()->roles->first()->nombre=='Administrador Main')
                    <td style="width:70px; text-align:center">
                      <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#deleteModal" data-postid="{{$productos->id}}"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    @endif
                  
                </tr>
                @endif
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

    <!-- delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you shure you want to delete this?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close" href="#">
              <span aria-hidden="true">×</span>
          </button>
          </div>
          <div class="modal-body">Select "delete" If you realy want to delete this category.</div>
          <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal" href="#">Cancel</button>
          @if ($productos->id=!false)
          <form method="POST" action="/category/{{$productos->id}}">
            @method('DELETE')
                @csrf
                <input type="hidden" id="post_id" name="post_id" value="">
                <a class="btn btn-primary" onclick="$(this).closest('form').submit();" href="#">Delete</a>
            </form>
          @endif
          
          </div>
      </div>
      </div>
  </div>
    

    <!-- /.content-wrapper -->
    @section('js_post_page')
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var post_id = button.data('postid') 
            var modal = $(this)
            modal.find('.modal-footer #post_id').val(post_id);
            modal.find('form').attr('action','/product/' + post_id);
        })
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