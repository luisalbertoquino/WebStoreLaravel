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
          <li class="breadcrumb-item active">Informe Productos</li>
          <li class="breadcrumb-item">
            <a href="/home">Informe Productos mas vendidos</a>
          </li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: bold;">
            <i class="fas fa-calendar"></i>
            REPORTE DE PRODUCTOS MAS VENDIDOS:<br> Seleccione la fecha inicial, fecha final y si desea filtrar por categoria
            <span style="float: left">
              <a href="/product2" class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
          </span>
        </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="tabla" width="100%" cellspacing="0">

                <!--date range-->
                <div class="row">
                  <div class="col-md-5">Total Records - <b><span id="total_records"></span></b></div>
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
                 </div>
                 <br>

          <!--continuacion de la tabla-->
                <thead class="thead-dark">
                  <tr>
                    <th>id</th>
                    <th>Producto</th>
                    <th>Descripcion</th>
                    <th>Stock</th>
                    <th>Costo</th>
                    <th>% Ganancia</th>
                    <th>valor de venta</th>
                    <th>categoria</th>
                
                  </tr>
                </thead>

                <tbody>
                  @foreach ($productos as $productos)
                  <tr>
                    <td>{{$productos->id}}</td>
                    <td>{{$productos->nombreProducto}}</td>
                    <td>{{$productos->detalleProducto}}</td>
                    <td>{{$productos->stock}}</td>
                    <td>{{$productos->costo}}</td>
                    <td>{{$productos->porcentajeGanancia}}</td>
                    <td>{{$productos->valorVenta}}</td>
                    <td>
                      @if ($productos->category['estado']==1)
                      {{$productos->category['categoria']}}
                      @else
                      No hay categoria disponible
                      @endif
                      </td>
                  </tr>
                  @endforeach
                
                </tbody>
              </table>
              {{ csrf_field()}}
              <span style="float:right">
                <button onclick="generarReporte()" class="btn btn-primary mt-4" id="btnObtenerValores">Generar reporte&ensp;&ensp;<i
                    class="fa fa-file-pdf-o" aria-hidden="true"></i></button></span>
            </div>
            </div>
          </div>
          <div class="card-footer small text-muted" style="text-align: center">Updated <input type="datetime" style="text-align: center" name="fecha"  readonly="true" value="<?php echo date("Y-m-d\TH-i");?>"></div>
        </div>

      </div>


    </div>

 

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