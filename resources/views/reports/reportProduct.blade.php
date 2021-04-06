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
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header" style="text-align: center">
            <i class="fas fa-table"></i>
            Generar  Nuevo Informe de Productos
            <span style="float: right">
            <button type="submit" class="btn btn-primary" >
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
            </button></span>
        </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="tabla" width="100%" cellspacing="0">

                <span style="float:left">
                    <input id="Date_search" style="form-control" size="25" type="date" placeholder="Fecha Inicial"  class="from-control" />
                    <button type="reset" class="reset" onclick="limpiar()"><i class="fa fa-repeat"
                        aria-hidden="true"></i></button>&ensp;&ensp;</span>
                <span style="float:center">
                            <input id="Date_search2" style="form-control" size="25" type="date" placeholder="Fecha Final"  class="from-control"/>
                            <button type="reset" class="reset" onclick="limpiar()"><i class="fa fa-repeat"
                                aria-hidden="true"></i></button>&ensp;&ensp;
                            <select class="js-example-basic-single "  data-live-search="true" style="form-control" >
                                <option value="" disabled selected style="form-control">Buscar por Proveedor</option>
                                @foreach ($categoria as $categoria)
                                    @if ($categoria->estado==1){
                                        <option value={{$categoria->id}}>{{$categoria->categoria}}</option>
                                     }
                                   @endif
                                    @endforeach
                              </select>
                            
                            <button type="reset" class="reset" id="clienteSearch"><i class="fa fa-search" aria-hidden="true"
                                onclick="buscarCliente()"></i></button>
                  </span>
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
                    <th>estado</th>
                    <th>editar</th>
                
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>id</th>
                    <th>Producto</th>
                    <th>Descripcion</th>
                    <th>Stock</th>
                    <th>Costo</th>
                    <th>% Ganancia</th>
                    <th>valor de venta</th>
                    <th>categoria</th>
                    <th>estado</th>
                    <th>editar</th>
                  </tr>
                </tfoot>

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
                     
                    <td  style="text-align: center;">
                      <!--cambiar estado-->
                      <form action="/product/estado/{{$productos->id}}" method="POST">
                        @method('PATCH')
                      {{csrf_field()}}
                        @if ($productos->estado==0)
                        <button class="btn btn-danger" type="submit"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                        @else
                        <button class="btn btn-success" type="submit" ><i class="fa fa-refresh" aria-hidden="true"></i></button>
                        @endif
                      </form>
                      </td> 
                      <!--editar-->
                      <td style="text-align: center;">
                        <form action="/product/{{ $productos['id'] }}/edit" method="GET">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </form>
                      </td>
                  </tr>
                  @endforeach
                
                </tbody>
              </table>
              <span style="float:right">
                <button onclick="generarReporte()" class="btn btn-primary mt-4" id="btnObtenerValores">Generar reporte&ensp;&ensp;<i
                    class="fa fa-file-pdf-o" aria-hidden="true"></i></button></span>
            </div>
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
          

  minDateFilter = "";
  maxDateFilter = "";
  minDateFilter2 = "";
  maxDateFilter2 = "";
  var fechasF = new Array;
  var fechasI = new Array;
  var cont = 0;
  $.fn.dataTableExt.afnFiltering.push(
    function (oSettings, aData, iDataIndex) {
      //Ventas realizadas y vigentes en un periodo de tiempo establecido
      if (typeof aData._date == 'undefined') {
        fechaVenta = new Date(aData[9]).getTime();
        fechaVencimiento = new Date(aData[3]).getTime();

      }
      if (minDateFilter && !isNaN(maxDateFilter)) {
        if (fechaVenta >= maxDateFilter) {
          return false;
        }
      }
      if (minDateFilter && !isNaN(minDateFilter)) {
        if (fechaVencimiento <= minDateFilter) {
          return false;
        }
      }
      fechasI[cont] = new Date(aData[2]);
      fechasF[cont] = fechaVencimiento;
      cont = cont + 1;

      //Ventas por vencer en un periodo de tiempo establecido
      if (typeof aData._date == 'undefined') {
        fechaVenta = new Date(aData[2]).getTime();
        fechaVencimiento = new Date(aData[3]).getTime();
      }
      if (minDateFilter2 && !isNaN(maxDateFilter2)) {
        if (fechaVenta >= maxDateFilter2) {
          return false;
        }
      }
      if (minDateFilter2 && !isNaN(maxDateFilter2)) {
        if (fechaVencimiento > maxDateFilter2) {
          return false;
        }
      }

      if (minDateFilter2 && !isNaN(maxDateFilter2)) {
        if (fechaVencimiento <= minDateFilter2) {
          return false;
        }
      }


      return true;
    }
  );
  $(document).ready(function () {
    $('.js-example-theme-single').select2({theme:"classic"});
    $("#Date_search").val("");
    $("#Date_search2").val("");
    //este comandito me quta el buscador que viene por defecto... 
    //$(".dataTables_filter").remove();
  });
  function cb(start, end) {
    if (start._isValid && end._isValid) {
      $('#daterange input').val(start.format('Do MMM YYYY') + ' - ' + end.format('Do MMM YYYY'));
    }
    else {
      $('#daterange input').val('');
    }
  };
  var table = $('#tabla').DataTable({

    "language": {
      "search": "_INPUT_",
      "searchPlaceholder": "Busqueda General"
    },
    "sDom": "lfrti",
    "deferRender": true,
    "responsive": true,
    "autoWidth": false,
    "paging": false,
    "info": false,
    "search": {
      "regex": true,
      "caseInsensitive": false,
      "tabla_filter": false,
    },
  });
  $("#Date_search").daterangepicker({
    "locale": {
      "autoApply": "true",
      "autoUpdateInput": "true",
      "cancelLabel": 'Clear',
      "autoUpdateInput": "false",
      "singleDatePicker": "true",
      "format": "DD-MM-YYYY",
      "separator": " / ",
      "applyLabel": "Buscar",
      "cancelLabel": "Cancelar",
      "fromLabel": "desde",
      "toLabel": "hasta",
      "customRangeLabel": "Custom",
      "weekLabel": "W",

      "daysOfWeek": [
        "Su",
        "Mo",
        "Tu",
        "We",
        "Th",
        "Fr",
        "Sa"
      ],
      "monthNames": [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
      ],
      "firstDay": 1
    },
  }, function (start, end, label) {
    maxDateFilter = end;
    minDateFilter = start;
    table.draw();

  });

  $("#Date_search2").daterangepicker({
    "locale": {
      "autoApply": "true",
      "autoUpdateInput": "true",
      "cancelLabel": 'Clear',
      "autoUpdateInput": "false",
      "singleDatePicker": "true",
      "format": "DD-MM-YYYY",
      "separator": " / ",
      "applyLabel": "Buscar",
      "cancelLabel": "Cancelar",
      "fromLabel": "desde",
      "toLabel": "hasta",
      "customRangeLabel": "Custom",
      "weekLabel": "W",

      "daysOfWeek": [
        "Su",
        "Mo",
        "Tu",
        "We",
        "Th",
        "Fr",
        "Sa"
      ],
      "monthNames": [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
      ],
      "firstDay": 1
    },
  }, function (start, end, label) {
    maxDateFilter2 = end;
    minDateFilter2 = start;
    table.draw();
  });
</script>

<script>
function generarReporte() {
  var doc = new jsPDF('p', 'mm', 'a3');

  //indico las columnas qu ellevara la tabla
  var columns = ["Id_Venta", "Cliente", "Fecha de venta", "Fecha de Fin", "Descripcion", "Precio", "Dias Restantes", "New Sale?"];

  //Preparo las variables que contendra la tabla
  var rowIndex = 0;
  var table = document.getElementById('tabla');
  var row = table.getElementsByTagName('tr')[rowIndex];
  var cells = row.getElementsByTagName('td');
  let data = [];

  //agrego los datos pertinentes al array que llevara la tabla
  var cont = document.getElementById("tabla").rows.length;


  //capturo la fecha actual y la pongo en español
  var f = new Date();
  //mes
  var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

  //imagen de prueba
  var img = new Image();

  var fechaActual = new Date;
  img.onload = function () {

    //proceso de escritura en el documento
    doc.setFontSize(10);
    doc.text(50, 20, f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear() + "                                                                               Informe de ventas No. " + fechaActual.getTime());
    //doc.addImage(img, 'JPEG', 20, 30, 1920, 1357);
    doc.text(50, 60, "El presente informe es para dar a conocer las ventas realizadas en el periodo " + $("#Date_search").val(""));
    doc.text(50, 70, " y las ventas que se encuentran por expirar en dicho tiempo; A continuacion se listaran los productos y su tiempo");
    doc.text(50, 80, "restante:");

    espacioLinea = 90
    /*for (var i = 1; i < cont; i++) {
      var cliente, fechaInicio, fechaFinal, descripcion, precio, estado;
      id = table.rows[i].cells[0].innerHTML;
      cliente = table.rows[i].cells[1].innerHTML;
      fechaInicio = table.rows[i].cells[2].innerHTML;
      fechaFinal = table.rows[i].cells[3].innerHTML;
      descripcion = table.rows[i].cells[4].innerHTML;
      precio = table.rows[i].cells[5].innerHTML;
      tiempoRestante = new Date(table.rows[i].cells[3].innerHTML).getDate() - new Date(table.rows[i].cells[2].innerHTML).getDate();
      doc.addImage(this,50, espacioLinea,15,15);
      espacioLinea = espacioLinea + 10;
      espacioLinea = espacioLinea + 10;
      doc.text(50, espacioLinea, "Cliente: " + cliente);
      espacioLinea = espacioLinea + 10;
      doc.text(50, espacioLinea, "El contrato se realizo el aaaa/mm/dd " + fechaInicio);
      espacioLinea = espacioLinea + 10;
      doc.text(50, espacioLinea, "y el termino de este se pacto para el aaaa/mm/dd " + fechaInicio);
      espacioLinea = espacioLinea + 10;
      doc.text(50, espacioLinea, "El producto es el siguiente:" + descripcion);
      espacioLinea = espacioLinea + 10;
      doc.text(50, espacioLinea, "El precio fue pactado por: " + precio);
      espacioLinea = espacioLinea + 10;
      doc.text(50, espacioLinea, "y el tiempo restante es: " + tiempoRestante + " dias");
      if (espacioLinea > 350) {
        doc.addPage();
        espacioLinea = 0;
      }
      espacioLinea = espacioLinea + 10;
    }

 
*/    var minSelector = minDateFilter;


    //codigo para la tabla en el pdf
    /*for (var i = 1; i < cont; i++) {

      var id, cliente, fechaInicio, fechaFinal, descripcion, precio, estado, dias_restantes, nueva_venta;
      id = table.rows[i].cells[0].innerHTML;
      cliente = table.rows[i].cells[1].innerHTML;
      fechaInicio = table.rows[i].cells[2].innerHTML;
      fechaFinal = table.rows[i].cells[3].innerHTML;
      descripcion = table.rows[i].cells[4].innerHTML;
      precio = "$" + table.rows[i].cells[5].innerHTML;
      resta = new Date(table.rows[i].cells[3].innerHTML).getTime() - fechaActual.getTime();
      dias_restantes = Math.round(resta / (1000 * 60 * 60 * 24));
      if (minDateFilter == "") {
        nueva_venta = "N/A";
      } else if (new Date(table.rows[i].cells[2].innerHTML) > minSelector) {
        nueva_venta = "SI";
      } else {
        nueva_venta = "NO";
      }*/

      var dataComp =
        [id, cliente, fechaInicio, fechaFinal, descripcion, precio, dias_restantes, nueva_venta];
      data.push(dataComp);

    }
    //añadir tabla al pdf
    doc.autoTable(columns, data,
      { margin: { top: 90 } }
    );
    img.src = "/img/calend.png";
  img.crossOrigin = "";

    doc.save('Products Never Purchased.pdf');
  };
  

</script>


@endsection