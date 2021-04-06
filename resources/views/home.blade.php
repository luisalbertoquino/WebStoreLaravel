@extends('layouts.app')
@section('content')

    <div id="content-wrapper"> 

      <div class="container-fluid">


    
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#">Home</a>
              </li>
              <li class="breadcrumb-item active">Resultados Generales de ventas</li>
            </ol>
           
            <!-- Icon Cards-->
            
          
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