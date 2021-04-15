<div class="card mb-3">
    <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: bold;">
      <i class="fas fa-table" style="color: #c2cfdd  ;"></i>&nbsp&nbsp
      REGISTRO DE VENTAS
      <span style="float: left">
        <a href="{{url()->previous()}}" class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
    </span>
    </div>
      
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <tr>
              <th><i class="fa fa-book" aria-hidden="true"></i></th>
              <th>Serie</th>
              <th>Vendedor</th>
              <th>Subtotal</th>
              <th>Iva</th>
              <th>Total</th>
              <th>Cliente</th>
              <th>Fecha</th>
            </tr>
          </thead>

          <tbody> 
            @php
                $acum= null; 
            @endphp
            @foreach ($venta as $venta)
            @if($acum != $venta->serialVenta)
            <tr>
              <td style="width:30px;text-align: center;">{{$venta->numeroVenta}}</td>
              <td>{{$venta->serialVenta}}</td>
              <td>{{$venta->usuario['nombre']}}&nbsp{{$venta->usuario['apellido']}}</td>
              <td>{{$venta->subtotal}}.00$</td>
              <td>{{$venta->iva}}%</td>
              <td>{{$venta->total}}.00$</td>
              <td>
                @if ($venta->cliente['estado']==1)
                {{$venta->cliente['numeroDocumento']}}-{{$venta->cliente['nombre']}}
                @else
                Sin Registro
                @endif
              </td> 
              <td>{{$venta->fechaEmision}}</td>

            </tr>
            @php
                $acum=$venta->serialVenta;
            @endphp
            @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted" style="text-align: center">Updated <input type="datetime" style="text-align: center" name="fecha"  readonly="true" value="<?php echo date("Y-m-d\TH-i");?>"></div>
  </div>