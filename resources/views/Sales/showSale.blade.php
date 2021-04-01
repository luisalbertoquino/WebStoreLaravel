@extends('layouts.app')
@section('content')

<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>


    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="/config">Ajustes</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="/roles">Roles Registrados</a>
          </li>
          <li class="breadcrumb-item active">Mostrar Rol</li>
        </ol>
        <div class="card card-login2 mx-auto mt-2" style="border:1px solid #666"> 
            <div class="card-header" style="text-align: left">
                <a href="{{url()->previous()}}" class="btn btn-primary">Regresar</a>
                <a href="{{url()->previous()}}" class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
            </div>
        <div class="card-body">

            <!--mensajes de error-->
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul >
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul> 
    </div>
    @endif

    <div class="card">
        <div class="container">
            <div class="invoice-box">
                
                <div class="table-responsive">
                <table class="table" cellpadding="0" cellspacing="0">
                    <tr class="top">
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td class="title">
                                        <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;">
                                    </td>
                            
                                    <td>
                                        Factura #  : {{$venta->numeroVenta}} <br>
                                        Fecha Atual: <?php echo date("Y-m-d");?><br>
                                        Fecha Venta: {{$venta->fechaEmision}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <tr class="information">
                        <td colspan="2">
                            <table>
                                <tr>
                                    <!---datos empresa general-->
                                    <td>
                                        Sparksuite, Inc.<br>
                                        12345 Sunny Road<br>
                                        Sunnyville, CA 12345
                                    </td>
                                    <!---datos contacto-->
                                    <td>
                                        Acme Corp.<br>
                                        John Doe<br>
                                        john@example.com
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <tr class="heading">
                        <td>
                            Datos Cliente
                        </td>

                        <td>
                            Vendedor
                        </td>
                        
                        
                    </tr>
                    
                    <tr class="details">
                        <td>
                            Nombre: @if ($venta->cliente['estado']==1)
                            {{$venta->cliente['nombre']}}
                            @else
                            Sin Registro
                            @endif <br>


                            Tipo Documento:@if ($venta->cliente['estado']==1)
                            @foreach($documento as $documento)
                            @if($venta->cliente['idDocumento']==$documento->id)
                            {{$documento->tipoDocumento}}
                            @endif
                            @endforeach
                            @else
                            Sin Registro
                            @endif <br>

                            # Documento:@if ($venta->cliente['estado']==1)
                            {{$venta->cliente['numeroDocumento']}}
                            @else
                            Sin Registro
                            @endif <br>
                        </td>
                        
                        <td>
                            {{$venta->usuario['nombre']}}&nbsp{{$venta->usuario['apellido']}}

                        </td>
                    </tr>

                    <tr class="heading">
                        <td>
                            Producto/Cantidad
                        </td>
                        <td>
                            Total $$
                        </td>
                    </tr>
                    
                    @foreach ($ventaFull as $ventaFull)
                    @if($venta->serialVenta==$ventaFull->serialVenta)
                    <tr class="item">
                        <td>
                            @if ($ventaFull->product['estado']==1)
                            {{$ventaFull->product['nombreProducto']}} (x{{$ventaFull['cantidadProducto']}})
                            @else
                            {{$ventaFull->product['nombreProducto']}} Descontinuado
                            @endif 
                        </td>
                            
                        <td>
                            <?php
                      $acum = NULL;
                      $acum= $ventaFull['cantidadProducto']*$ventaFull->product['valorVenta'];     
                            ?>
                            {{$acum}}.00 $$
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    
                    
                    <tr class="total">
                        <td></td>
                        
                        <td>
                            SubTotal:{{$ventaFull['subtotal']}}.00 $$<br>
                            Total Impuestos:{{$ventaFull['iva']}} <br>
                            Descuentos Adicionales:.00 $$ <br>
                           Total: {{$venta->total}}.00 $$
                        </td>
                    </tr>
                </table>
            </div>
            
        </div>
        
    </div>

    </div>
        
          </div>

    </div>

      
</div>

      
@endsection