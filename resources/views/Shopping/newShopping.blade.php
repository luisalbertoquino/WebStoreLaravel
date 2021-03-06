@extends('layouts.app')
@section('content')

    <div id="content-wrapper">
        <form method="POST" action="/shopping">
            @csrf
        <div class="container-fluid">

            <!-- Hipervinculos-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/home">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="/shopping">Compras</a>
            </li>
            <li class="breadcrumb-item active">Nueva Compra</li>
        </ol>
            <!--Para la fecha-->
            <?php
            $fecha = date('Y-m-d');
            $acum = 0;
            $pinaculo=0;
            foreach ($compra as $compra) {
               $pinaculo=$compra->id;
            }
            if ($pinaculo ==0) {
            $acum = $acum+1;
            } else {
            $acum = $compra->numeroVenta + 1;
            }
            ?>
            <!--Primer div para laseleccion de productos-->
            <div class="card card-login2 mx-auto mt-2" style="border:1px solid #666">
                <!--Cabecera de la card-->
                <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: bold;">
                    <span style="float: center">
                        REGISTRAR NUEVA COMPRA&nbsp&nbsp
                    <i class="fa fa-truck" aria-hidden="true" style="color: #34495E"></i>
                    </span>
                    
                    <!--Fecha-->
                <span style="float: right">
                    <input id="fechaEmision" type="text" style="text-align: center;  border: 0;outline: none;width: 120px;" class="form-control" name="fechaEmision" value="{{ $fecha }}" readonly>
                </span>
                <!--boton regresar-->
                <span style="float: left">
                    <a href="{{url()->previous()}}" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                </span>
                </div>
                <br>
                <!--cuerpo de la card-->
                <div class="form-group row">
                    <!--Vendedor-->
                    <label for="descripcion" class="col-md-2 col-form-label text-md-right">{{ __('Registrador') }}</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="idUsuario2" autofocus="true" disabled value="{{ auth()->user()->nombre }} {{ auth()->user()->apellido }}">
                        <input type="text" id="idUsuario" name="idUsuario" value="{{ auth()->id() }}" hidden>
                    </div>
                    <!--Seleccion de cliente-->
                    <label for="descripcion" class="col-md-2 col-form-label text-md-right">{{ __('Proveedor') }}</label>
                    <div class="col-md-4">
                        <select class="js-example-theme-single form-control" data-live-search="true" id="idProveedor" name="idProveedor" style="width: 150px" onchange="fock.call(this, event)">
                            <option value="" class="form-control" disabled selected>Buscar Proveedor</option>
                            <option value="0">Sin Registro</option>
                            @foreach ($proveedor as $proveedor)
                                <option onselect="asignarCliente('{{ $proveedor->razonSocial }}','{{ $proveedor->numeroDocumento }}')"
                                    value={{ $proveedor->id }}>{{ $proveedor->numeroDocumento }}-{{ $proveedor->razonSocial }}</option>
                            @endforeach
                        </select>
                        <!--Boton para crear un nuevo cliente-->
                        <span style="float:right">
                            <a class="btn btn-primary" href="/provider/create"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                        </span>
                    </div>
                </div>

                <!--Nuevo card body donde va la tabla del stock-->
                <div class="card-body">
                        <!--serial venta-->
                    <div class="form-group row">
                        <label for="descripcion" class="col-md-2 col-form-label text-md-right">{{ __('Factura No') }}</label>
                        <div class="col-md-2">
                            <input id="factura" type="number" class="form-control" style="text-align: center" name="factura" readonly value="{{ $tiempo = time() }}">
                        </div>
                        <!--numero compra-->
                        <label for="descripcion" class="col-md-3 col-form-label text-md-right">{{ __('# Comprobante') }}</label>
                        <div class="col-md-4">
                            <input id="numeroComprobante" type="number" class="form-control" style="text-align: center" name="numeroComprobante" required>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                    <!--Serie Comprobante-->
                    <label for="descripcion" class="col-md-7 col-form-label text-md-right">{{ __('Serie Comprobante') }}</label>
                    <div class="col-md-4">
                        <input id="serieComprobante" type="text" class="form-control" style="text-align: center" name="serieComprobante" required>
                    </div>
                    </div> <br>
                    
                
                        <!--mensajes de error de la comprobacion de datos en el controller-->
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!--producto-->
                    <div class="card mb-3" >
                        <label for="descripcion" class="col-md-2 col-form-label text-md-right"></label>
                        <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: bold;">
                            <i class="fa fa-th-large" style="color: #0860b8  ;" aria-hidden="true"></i>&nbsp&nbsp
                            TABLA DE PRODUCTOS:<br> Seleccione el producto, la cantidad a comprar y las operaciones correspondientes</div><br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th title="NOMBRE DE PRODUCTO">Product</th>
                                            <th title="CANTIDAD DISPONIBLE">C/U</th>
                                            <th title="VALOR VENTA">Precio</th>
                                            <th title="A??ADIR IVA?">Iva?</th>
                                            <th title="CATEGORIA DE PRODUCTO">Category</th>
                                            <th title="CANTIDAD" style="text-align: center"><i class="fa fa-shopping-basket" aria-hidden="true"></i></th>
                                            <th title="DESCUENTO" style="text-align: center"><i class="fa fa-tag" aria-hidden="true"></i><i class="fa fa-percent" aria-hidden="true"></i></th>
                                            <th title="A??ADIR A LA LISTA" style="text-align: center"><i class="fa fa-plus" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($producto as $producto)
                                        <tr>
                                            <!--nombre producto-->
                                            <td style="width:30px;" id="producto{{ $producto->id }}">{{ $producto->nombreProducto }}</td>
                                            <!--stock-->
                                            @if ($producto->stock > 0)
                                            <td>
                                                <input for="" id="stock1{{ $producto->id }}" readonly  value="{{ $producto->stock }}" style="text-align: center;border:0;width:50px;outline: none;background-color: #dfe;">
                                            </td>
                                            @else
                                            <td style="text-align: center"> 
                                                <input for="" id="stock1{{ $producto->id }}" readonly  value="{{ $producto->stock }}" style="text-align: center;border:0;width:50px;outline: none;background-color: red;color:#ffff">     
                                            </td>
                                            @endif
                                            <!--costo-->
                                            <td><input for="" id="costa{{ $producto->id }}" name="costa{{ $producto->id }}" style="text-align: center;border:0;width:70px;outline: none;" readonly value="{{ ($producto->valorVenta*0.19)+$producto->valorVenta }}"></td>
                                            <!--iva-->
                                            <td style="text-align: center"><input type="checkbox"  id="ivan{{ $producto->id }}" name="ivan" checked="true" onchange="funcionIva({{ $producto['valorVenta'] }},{{ $producto->id }})"  style=" box-shadow: none;"> </td>
                                            <td style="width:30px;">
                                                @if ($producto->category['estado'] == 1)
                                                    {{ $producto->category['categoria'] }}
                                                @else
                                                    No Disponible
                                                @endif
                                            </td>
                                            <td>
                                                    <input id="cantidad{{ $producto->id }}" value="1" type="number" class="form-control" name="cantidadProducto" required style="width: 70px" autofocus="true" min="1" max="{{ $producto->stock }}">
                                                   
                                            </td>
                                            
                                            <!--descuento-->
                                            <td>
                                                <input type="number" id="descuento{{ $producto->id }}" min="0" max="100" maxlength="3" aria-valuemax="100" name="descuento{{ $producto->id }}"  maxlength="3" class="form-control" style="width: 70px" placeholder="0" value="0">
                                            </td>

                                            <td>
                                                <!--a??adir-->
                                                <?php
                                                $iva = $producto->iva;
                                                $stock = $producto->stock;
                                                $precio = $producto->valorVenta;
                                                ?>
                                                    <a href="javascript:void(0)" id="plus{{ $producto->id }}" onclick="funcion('{{ $producto['nombreProducto'] }}',{{ $producto['valorVenta'] }},{{ $producto['stock'] }},{{ $producto->id }},{{$config->ivaActual}},{{$config->impuestos}})"
                                                    class="btn btn-primary"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        
                    </div>  
                       
                </div>


                <!--opcion Comprar-->
                <div class="form-group row col-md-5">
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-success " >{{ __('Registrar Compra') }}
                        </button>&nbsp&nbsp
                </div>
                <!--estado-->
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="form-group" class="form-control">
                            <select name="estado" id="estado" hidden="true">
                                <option value="1" selected>Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
                    <input type="text" id="idProducto" name="idProducto" hidden  >
                    <input type="text" id="cantidadProducto" name="cantidadProducto" hidden>
                    <input type="text" id="iva" name="iva" hidden>
                    <input type="text" id="descuentoPorcentaje" name="descuentoPorcentaje" hidden>
                    <input type="text" id="impuesto" name="impuesto" value="0" hidden >
 
                   
                    
                
            </div>


              


            <!--vista previa de factura************************************************************************-->
            <div class="card card-login2 mx-auto mt-2" style="border:1px solid #666;" >
                <input id="fechaEmision2" type="date" class="form-control" name="fechaEmision2" value="{{ $fecha }}" readonly>
                <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: bold;">Lista de compras &nbsp&nbsp<i class="fa fa-list" aria-hidden="true"></i> </div>

                <div class="card-body">

                    <!--subtotal-->
                <div class="form-group row">
                    <label for="descripcion" class="col-md-5 col-form-label text-md-right">{{ __('Subtotal') }}</label>
                    <div class="col-md-4">
                        <input id="subtotal" type="number" class="form-control"  name="subtotal" autofocus="true" readonly>
                    </div>
                    <label  for="">.00 $$</label>
                 
                </div>
                <!--iva-->
                <div class="form-group row">    
                    <label for="descripcion" class="col-md-5 col-form-label text-md-right">{{ __('Iva Total') }}</label>
                    <div class="col-md-4">
                        <input id="ivaAcum" type="number"  class="form-control" name="ivaAcum" autofocus="true" readonly>
                    </div>
                    <label for="">.00 $$</label>
                </div>
                <!--descuento-->
                <div class="form-group row">    
                    <label for="descripcion" class="col-md-5 col-form-label text-md-right">{{ __('Descuento Total') }}</label>
                    <div class="col-md-4">
                        <input id="totalDescontado" type="number"  class="form-control" name="totalDescontado" autofocus="true" readonly>
                    </div>
                    <label for="">.00 $$</label>
                </div>
                <!--total-->
                <div class="form-group row">    
                    <label for="descripcion" class="col-md-5 col-form-label text-md-right">{{ __('Total') }}</label>
                    <div class="col-md-4">
                        <input id="total" type="number"  class="form-control" name="total" autofocus="true" readonly>
                    </div>
                    <label for="">.00 $$</label>
                </div><br>
                <div class="table-responsive">
                    <div class="form-group">
                        <label title="nombre producto" for="" class="col-md-2 col-form-label text-md-right" style="font-weight: bold;">Producto</label>
                        <label title="cantidad producto" for="" class="col-md-2 col-form-label text-md-right" style="font-weight: bold;">Cantidad</label>
                        <label title="precio producto" for="" class="col-md-2 col-form-label text-md-right" style="font-weight: bold;">Precio c/u</label>
                        <label title="descuento asignado" for="" class="col-md-2 col-form-label text-md-right" style="font-weight: bold;">Desc&nbsp<i class="fa fa-tag" aria-hidden="true"></i><i class="fa fa-percent" aria-hidden="true"></i></label>
                        <label title="iva producto" for="" class="col-md-1 col-form-label text-md-right" style="font-weight: bold;">Iva</label>
                        <label title="total producto" for="" class="col-md-2 col-form-label text-md-right" style="font-weight: bold;">Total</label>
                        
                    </div>

                    <div class="form-group" id="factura2" style="align-content: center">
                       
                    </div>
                </div>
                
                    <br>

            </div>
            </div>

             <!--vista previa factura-->
             <div class="card card-login2 mx-auto mt-2" style="border:1px solid #666;" id="pdf" name="pdf">
                <div class="card-header" style="text-align: center;font-size:15px; color:#34495E ;font-weight: bold;">Factura Generada &nbsp&nbsp<i class="fa fa-list" aria-hidden="true"></i> </div>
                <!--ACA VIENE EL COPY Y PASTE DE L ANUEVA FACTURA-->
                <div class="card" id="card1">
                    <div class="container" id="card">
                        <div class="invoice-box">
                            
                            <div class="table-responsive">
                            <table class="table" id="tablita" cellpadding="0" cellspacing="0" style="background-image: linear-gradient(rgba(255,255,255,0.5), rgba(255,255,255,0.5)), url({{ Storage::url($config->nombreLogo)}}); background-repeat: no-repeat;background-size:100%;background-position: center;">
                                
                                <tr class="top">
                                    <td colspan="2">
                                        <table>
                                            <tr>
                                                <td class="title">
                                                    <img  src="{{ Storage::url($config->logo)}}" style="width:100px; max-width:300px;">
                                                </td>
                                        
                                                <td>
                                                    Factura de venta#  : {{$acum }}<br>
                                                    Fecha Atual: <?php echo date("Y-m-d");?><br>
                                                    Fecha Venta: <?php echo date("Y-m-d");?> 
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
                                                    {{$config->nombreEmpresa}}<br>
                                                    Nit. {{$config->nit}}<br>
                                                    tel. {{$config->telefono}}
                                                </td>
                                                <!---datos contacto-->
                                                <td>
                                                    {{$config->razonSocial}}<br>
                                                    Webside:{{$config->paginaWeb}}<br>
                                                    {{$config->email}}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                <tr class="heading">
                                    <td>
                                        Datos Proveedor
                                    </td>
            
                                    <td>
                                        Recibido por
                                    </td>
                                    
                                    
                                </tr>
                                
                                <tr class="details">
                                    <td>
                                        <label id="clienter" type="text"></label><br>
            
            
                                        Tipo Documento:Cedula de ciudadania <br>
            
                                        # Documento:1075389698<br>
                                    </td>
                                    
                                    <td>
                                        {{ auth()->user()->nombre }} {{ auth()->user()->apellido }}
            
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
                                
                               
                                <tr class="item">
                                    <td>
                                        Descontinuado
                                    </td>
                                        
                                    <td>
                                        20000.00 $$
                                    </td>
                                </tr>
    
                                
                                
                                <tr class="total">
                                    <td></td>
                                    
                                    <td>
                                        SubTotal:.00 $$<br>
                                        Total Impuestos: <br>
                                        Descuentos Adicionales:.00 $$ <br>
                                       Total:.00 $$
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                    </div>
                    
                </div>
            
                </div>

               


            </div>
        </form>
        </div>

        

        <script>

    







            //variables de la primera vista
            var subtotal = 0;
            var total = 0;
            var stock = 0;
            var cont = 0;
            var descuento=0;
            var cantidad2 = 0;
            var cantidad3 = 0;
            var ivaAcum =0;
            var ivaIndi =0;
            var descuentoAcum=0;
            var iProduct =  new Array(); //idProducto
            var cProduct =  new Array(); //cantidadProducto
            var ivaProduct =  new Array(); //cantidadProducto
            var disProduct =  new Array(); //descuento si hay de Producto
            var disCant = new Array(); //cuanto desconto en dinero
            var ide= "";
            var iva;


            function fock(event){
                $('#clienter').html(this.options[this.selectedIndex].text); 
            };

            

            $(function() { 
                $('#download').click(function() {
                    var element = document.getElementById('card1');
                html2pdf(element, {
                margin: 0,
                filename: 'myfile.pdf',
                image: { type: 'jpeg', quality: 1},
                html2canvas: { scale: 2, logging: true },
                jsPDF: { unit: 'in', format: 'a4' }
});
                      
                });
                });
            
                function funcionIva(costo, idef) {
                ibas=document.getElementById("costa"+idef).value;
                compara=(costo*0.19)+costo;
                if(compara-ibas==0){
                    document.getElementById("costa"+idef).setAttribute("value", costo);
                }else{
                    document.getElementById("costa"+idef).setAttribute("value", compara);
                }

            };

            function funcionIva(costo, idef) {
                ibas=document.getElementById("costa"+idef).value;
                compara=(costo*0.19)+costo;
                if(compara-ibas==0){
                    document.getElementById("costa"+idef).setAttribute("value", costo);
                }else{
                    document.getElementById("costa"+idef).setAttribute("value", compara);
                }

            };

            function funcion(productos, costos, cantidades, idd, impuestoIva,impuestoOtro) {
                //cantidad de producto
                cont = document.getElementById("cantidad" + idd).value;
                //descuento si hay
                descu = document.getElementById("descuento" + idd).value;
                //nuevo valor para la tabla de cantidad
                cantidad2 = cantidades - cont;
                cantidad3 = cantidades + cont;
                //identificacion del producto seleccionado
                ide=document.getElementById("producto"+idd).value;
                //convierto las variables a entero y verifico que hay en el inventario
                var cuantoHay = parseInt(cantidades);
                var cuantoVendo = parseInt(cont);
               
                    //multiplico por cantidad de producto
                    costosSumados=costos*cont;
                    //subtotal acumulador normal de costos sin iva y descuento
                    subtotal = subtotal + costosSumados;
                    //aplico el descuento correspondiente
                    descuentoAcum=descuentoAcum+(costosSumados*(descu/100));
                    //aca se valida que opcion se marco en el check si 1 o 0
                    ibas=document.getElementById("costa"+idd).value;
                    //aca  decido si sumo el iva o no
                   
                    if(costos-ibas==0){
                        total=total+costosSumados-(costosSumados*(descu/100));
                        
                    }else{
                        var ivaA = (((impuestoIva/100) * costosSumados) + costosSumados)-(costosSumados*(descu/100));
                        total = total + ivaA;
                        ivaAcum=ivaAcum+((impuestoIva/100) * costosSumados);
                        ivaIndi=(impuestoIva/100) * costosSumados;
                    }
                    
                    //*****************************
                    //Array para cantidad
                    iProduct.push(idd); //id de producto adquirido
                    cProduct.push(cont); //cantidad de producto
                    ivaProduct.push(ivaIndi); //iva del producto individual
                    disProduct.push(descu); //porcentaje de descuento
                  
                   
                    //para alterar cambios en la tabla
                    //deshabilito la fila debido a que ya exprese la cantidad de ese producto inicial
                    //si requiero cambiar la cantidad debo eliminarlo de la list
                    document.getElementById("cantidad"+idd).disabled=true;
                    document.getElementById("plus"+idd).setAttribute("hidden","true");
                    document.getElementById("ivan"+idd).disabled=true;
                    document.getElementById("descuento"+idd).disabled=true;
                    document.getElementById("cantidadProducto").setAttribute("value", cProduct);
                    document.getElementById("idProducto").setAttribute("value", iProduct);
                    document.getElementById("stock1" + idd).setAttribute("value", cantidad2+(cont*2));
                    
                   
                    //variables ocultas
                    document.getElementById("iva").setAttribute("value", ivaProduct);
                    document.getElementById("descuentoPorcentaje").setAttribute("value", disProduct);
                    

                    //resumen general de totales

                    document.getElementById("subtotal").setAttribute("value", subtotal);
                    document.getElementById("ivaAcum").setAttribute("value", ivaAcum);
                    document.getElementById("totalDescontado").setAttribute("value", descuentoAcum);
                    document.getElementById("total").setAttribute("value", total);
                    

                    //valores plasmados en la factura
                    //document.getElementById("iva2").setAttribute("value", iva);
                    //document.getElementById("total2").setAttribute("value", total);
                    //document.getElementById("subtotal2").setAttribute("value", subtotal);
                   
                    
                    //*********variables de la lista****************

                    //a??adir salto de linea
                    var br = document.createElement("br");
                    var img = document.createElement("i");
                    img.className = "fa fa-times";
                    img.setAttribute('aria-hidden', 'true');
                    var capa = document.getElementById("factura2");
                    

                    //primero creare el boton de eliminar
                    var boton = document.createElement("a");
                    boton.className = "btn btn-danger col-md-2 col-form-label text-md-right";
                    boton.style='width:40px; ';
                    boton.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>'
                    boton.setAttribute("href","javascript:void(0)");
                    boton.onclick = deleteElemento;
                    
                    //creare el label de subtotal
                    var producto = document.createElement("label");
                    producto.setAttribute("id", "prod");
                    producto.className = "col-md-2 col-form-label text-md-right";
                    producto.innerHTML = productos;
                    

                    //label para cantidad
                    var cantidad = document.createElement("label");
                    cantidad.className = "col-md-2 col-form-label text-md-right";
                    cantidad.innerText = cont+' units';

                    //label para precio unitario
                    var precio = document.createElement("label");
                    precio.className = "col-md-2 col-form-label text-md-right";
                    precio.innerText = costos+'.00$$';

                    //label para descuento 
                    var descue = document.createElement("label");
                    descue.className = "col-md-2 col-form-label text-md-right";
                    descue.innerText = descu+'%';

                    //label para iva
                    var ivancio = document.createElement("label");
                    ivancio.className = "col-md-1 col-form-label text-md-right";
                    ivancio.innerText = "19%";

                    //label para precio total, todo un cache
                    var precionso = document.createElement("label");
                    precionso.className = "col-md-2 col-form-label text-md-right";
                    precionso.innerText = total+'.00$';

                    //creo un espacio
                    var espacio = document.createElement("div");
                    espacio.setAttribute("id", espacio);

                    //asignacion al documento html

                    var ope = document.createElement("br");
                    capa.appendChild(espacio);
                    espacio.appendChild(producto);
                    espacio.appendChild(cantidad);
                    espacio.appendChild(precio);
                    espacio.appendChild(descue);
                    espacio.appendChild(ivancio);
                    espacio.appendChild(precionso);
                    espacio.appendChild(boton);
                    espacio.appendChild(ope);
                    


                    //*******************eliminar elemento de la lista****************
                    function deleteElemento() {
                            //obtengo el valor del div donde trabajare la lista
                            var capa = document.getElementById("factura2");
                            //btengo la cantidad de producto original
                            contar = document.getElementById("stock1" + idd).value;
                            
                            cont = cantidades-contar;
                            
                        ibas=document.getElementById("costa"+idd).value;
                        //volver a la situacion, y revertir el iva
                        pos2 = iProduct.indexOf(idd);
                        cantares=cProduct[pos2]; //cantidad de producto
                        cantares2=(disProduct[pos2])/100; //cuanto fue el descuento
                        cantares3=ivaProduct[pos2]; //cuanto fue el iva
        
                        if(costos-ibas==0){
                            costosSumados=costos*cantares; //estes costos esta por defecto no esta tomando el iva
                            subtotal = subtotal - costosSumados;
                            total=total-costosSumados+(costosSumados*cantares2);
                            descuentoAcum=descuentoAcum-(costosSumados*cantares2);
                            
                        }else{
                            iva=(impuestoIva/100);
                            costosSumados=costos*cantares; //estes costos esta por defecto no esta tomando el iva
                            subtotal = subtotal - costosSumados;
                            ivaA = cantares3 + costosSumados;
                            total=total-ivaA+(costosSumados*cantares2);
                            ivaAcum=ivaAcum-cantares3;
                            descuentoAcum=descuentoAcum-(costosSumados*cantares2);
                        }
                            //limpio las posiciones de los vectores
                            
                        
                            pos2 = iProduct.indexOf(idd);
                            cProduct.splice(pos2, 1);
                            iProduct.splice(pos2, 1);
                            ivaProduct.splice(pos2, 1);
                            disProduct.splice(pos2, 1);
                            

                        //reasigno a la tabla
                            document.getElementById("ivan"+idd).disabled=false;
                            document.getElementById("descuento"+idd).disabled=false;
                            document.getElementById("cantidadProducto").setAttribute("value", cProduct);
                            document.getElementById("idProducto").setAttribute("value", iProduct);
                            document.getElementById("stock1" + idd).setAttribute("value", cantidades);

                        //variables ocultas
                            document.getElementById("iva").setAttribute("value", ivaProduct);
                            document.getElementById("descuentoPorcentaje").setAttribute("value", disProduct);
                            
                            //asignacion inversa a los totales
                            document.getElementById("subtotal").setAttribute("value", subtotal);
                            document.getElementById("ivaAcum").setAttribute("value", ivaAcum);
                            document.getElementById("totalDescontado").setAttribute("value", descuentoAcum);
                            document.getElementById("total").setAttribute("value", total);
                            
                            //document.getElementById("iva2").setAttribute("value", iva);
                            //document.getElementById("total2").setAttribute("value", total);
                            //document.getElementById("subtotal2").setAttribute("value", subtotal);
                        
                    
                            //
                            //var borrardiv = capa.lastChild;
                            document.getElementById("plus"+idd).removeAttribute("hidden")
                            document.getElementById("cantidad"+idd).disabled=false;
                            capa.removeChild(espacio);
                    }
                
            }
            function buscarSelect() {
                // creamos un variable que hace referencia al select
                var select = document.getElementById("elementos");
                // obtenemos el valor a buscar
                var buscar = document.getElementById("buscar").value;
                // recorremos todos los valores del select
                for (var i = 1; i < select.length; i++) {
                    if (select.options[i].text == buscar) {
                        // seleccionamos el valor que coincide
                        select.selectedIndex = i;
                    }
                
            }
            }
        </script>
        <script>
            $(document).ready(function() {
                $('.js-example-theme-single').select2({theme:"classic"});
                $('#dataTable').DataTable({
                   
                });

            });
        </script>
    @endsection
