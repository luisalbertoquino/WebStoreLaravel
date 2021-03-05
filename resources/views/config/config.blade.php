@extends('layouts.app')
@section('content')

    <div id="content-wrapper"> 

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a> 
          </li>

          <li class="breadcrumb-item active">Ajustar Opciones Del sistema</li>
          <form method="get" action="/user/{{$ide=auth()->id()}}/edit" style="margin-left: auto;">
            <button type="submit" class="btn btn-primary" >
              {{ __('Home ') }}&nbsp&nbsp<i class="fa fa-plus" aria-hidden="true"></i>
          </button>
            </form>
        </ol>
            <div class="col-md-4 col-form-label text-md-right">
            <form method="get" action="/user/{{auth()->user()->id}}/edit" style="margin-left: auto;">
                <button type="submit" class="btn btn-primary" >
                  {{ __('Editar Opciones de cuenta') }}&nbsp&nbsp<i class="fa fa-id-card-o" aria-hidden="true"></i>
              </button>
            </form>
            </div>
            <div class="col-md-4 col-form-label text-md-right">
              <form method="get" action="/document" style="margin-left: auto;">
                <button type="submit" class="btn btn-primary" >
                  {{ __('Tipos de id registrados') }}&nbsp&nbsp<i class="fa fa-users" aria-hidden="true"></i>
              </button>
              </form> 
            </div>
            <div class="col-md-4 col-form-label text-md-right">
              <form method="get" action="/document/create" style="margin-left: auto;">
                <button type="submit" class="btn btn-primary"  >
                  {{ __('Gestionar tipos de id del sistema') }}&nbsp&nbsp<i class="fa fa-plus-circle" aria-hidden="true"></i>
              </button>
              </form>
            </div>
       

        <!-- DataTables Example -->
        
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->

    </div>
    <!-- /.content-wrapper -->

@endsection