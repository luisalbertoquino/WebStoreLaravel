@extends('layouts.app')
@section('content')

    <div id="content-wrapper"> 

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a>
          </li>
          <li class="breadcrumb-item active">Informes</li>
          <li class="breadcrumb-item active">Informe Ventas</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: bold;">
            <i class="fas fa-calendar"></i>
            REPORTE DE VENTAS:<br> Seleccione la fecha inicial, fecha final y si desea filtrar por cliente
            <span style="float: left">
              <a href="/product2" class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
          </span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                
                <!--date range-->
                <div class="row">
                  <div class="col-md-3">Datos Almacenados - <b><span id="total_records"></span></b></div>
                  <div class="col-md-5">
                   <div class="input-group input-daterange">
                       <input type="text" name="from_date" id="from_date" readonly class="form-control" />
                       <div class="input-group-addon">&ensp;hasta&ensp;</div>
                       <input type="text"  name="to_date" id="to_date" readonly class="form-control" />
                   </div>
                  </div>
                  <div class="col-md-2">
                   <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
                   <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
                  </div>
                  <div class="col-md-2">
                    <select class="js-example-basic-single form-control "  data-live-search="true" >
                      <option value="" disabled selected>Buscar por Cliente</option>
                      @foreach ($cliente as $cliente)
                          @if ($cliente->estado==1){
                          <option onclick="asignarCliente('{{$cliente['nombre']}}'.{{$cliente->numeroDocumento}})" value={{$cliente->id}} >{{$cliente->numeroDocumento}}-{{$cliente->nombre}}</option>
                           }
                         @endif
                      @endforeach
                  </div>
                 </div>
                 
                <thead class="thead-dark">
                  <br>
                  <tr>
                    <th>venta N°</th>
                    <th>Serial Venta</th>
                    <th>Vendedor</th>
                    <th>Producto</th>
                    <th>Cantidad Producto</th>
                    <th>Subtotal</th>
                    <th>Iva</th>
                    <th>Total</th>
                    <th>Cliente</th>
                    <th>Fecha Venta</th>
                
                  </tr>
                </thead>

                <tbody>
                  @foreach ($venta as $venta)
                  <tr>
                    <td style="width:30px;">{{$venta->numeroVenta}}</td>
                    <td>{{$venta->serialVenta}}</td>
                    <td>{{$venta->idUsuario}}</td>
                    <td>
                      @if ($venta->product['estado']==1)
                      {{$venta->product['nombreProducto']}}
                      @else
                      Producto agotado o no dispo
                      @endif
                    </td>
                    <td style="width:90px;">{{$venta->cantidadProducto}}</td>
                    <td>{{$venta->subtotal}}</td>
                    <td>{{$venta->iva}}</td>
                    <td>{{$venta->total}}</td>
                    <td>
                        @if ($venta->cliente['estado']==1)
                      {{$venta->cliente['numeroDocumento']}}-{{$venta->cliente['nombre']}}
                      @else
                      No exist
                      @endif
                    </td> 
                    <td>{{$venta->fechaEmision}}</td>
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
  $(document).ready(function(){
    $('.js-example-theme-single').select2({theme:"classic"});

   var date = new Date();
  
   $('.input-daterange').datepicker({
    todayBtn: 'linked',
    format: 'yyyy-mm-dd',
    autoclose: true
   });
  
   var _token = $('input[name="_token"]').val();
  
   fetch_data();
  
   function fetch_data(from_date = '', to_date = '')
   {
    $.ajax({
     url:"{{ route('daterange.fetch_data') }}",
     method:"POST",
     data:{from_date:from_date, to_date:to_date, _token:_token},
     dataType:"json",
     success:function(data)
     {
      var output = '';
      $('#total_records').text(data.length);
      for(var count = 0; count < data.length; count++)
      {
       output += '<tr>';
       output += '<td>' + data[count].post_title + '</td>';
       output += '<td>' + data[count].post_description + '</td>';
       output += '<td>' + data[count].date + '</td></tr>';
      }
      $('tbody').html(output);
     }
    })
   }
  
   $('#filter').click(function(){
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    if(from_date != '' &&  to_date != '')
    {
     fetch_data(from_date, to_date);
    }
    else
    {
     alert('Both Date is required');
    }
   });
  
   $('#refresh').click(function(){
    $('#from_date').val('');
    $('#to_date').val('');
    fetch_data();
   });
  
  
  });
  </script>

@endsection