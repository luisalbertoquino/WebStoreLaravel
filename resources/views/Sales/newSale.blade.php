@extends('layouts.app')
@section('content')

    <div id="content-wrapper">
        <form method="POST" action="/sale">
            @csrf
        <div class="container-fluid">

            <!-- Hipervinculos-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/home">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="/sale">Ventas</a>
                </li>
                <li class="breadcrumb-item active">Nueva Venta</li>
            </ol>
            <!--Para la fecha-->
            <?php
            $fecha = date('Y-m-d');
            $acum = 0;
            $pinaculo=0;
            foreach ($venta as $venta) {
               $pinaculo=$venta->numeroVenta;
            }
            if ($pinaculo ==0) {
            $acum = $acum+1;
            } else {
            $acum = $venta->numeroVenta + 1;
            }
            ?>
            <!--Primer div para laseleccion de productos-->
            <div class="card card-login2 mx-auto mt-2" style="border:1px solid #666">
                <!--Cabecera de la card-->
                <div class="card-header" style="text-align: center;font-size:20px">REGISTRAR NUEVA VENTA&nbsp&nbsp<i class="fa fa-book"
                        aria-hidden="true"></i>
                    <span style="float:right">
                        <!--Fecha-->
                        <input id="fechaEmision" type="text" style="text-align: center;  border: 0;outline: none;width: 120px;" class="form-control" name="fechaEmision" value="{{ $fecha }}" readonly>
                    </span>
                </div>
                <br>
                <!--cuerpo de la card-->
                <div class="form-group row">
                    <!--Vendedor-->
                    <label for="descripcion" class="col-md-2 col-form-label text-md-right">{{ __('Vendedor') }}</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="idUsuario2" autofocus="true" disabled value="{{ auth()->user()->nombre }} {{ auth()->user()->apellido }}">
                        <input type="text" id="idUsuario" name="idUsuario" value="{{ auth()->id() }}" hidden>
                    </div>
                    <!--Seleccion de cliente-->
                    <label for="descripcion" class="col-md-2 col-form-label text-md-right">{{ __('Cliente') }}</label>
                    <div class="col-md-4">
                        <select class="js-example-theme-single form-control" data-live-search="true" id="idCliente" name="idCliente" style="width: 150px" onchange="fock.call(this, event)">
                            <option value="" class="form-control" disabled selected>Buscar Cliente</option>
                            <option value="0">Sin Registro</option>
                            @foreach ($cliente as $cliente)
                                <option onselect="asignarCliente('{{ $cliente->nombre }}','{{ $cliente->numeroDocumento }}')"
                                    value={{ $cliente->id }}>{{ $cliente->numeroDocumento }}-{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                        <!--Boton para crear un nuevo cliente-->
                        <span style="float:right">
                            <a class="btn btn-primary" href="/client/create"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                        </span>
                    </div>
                </div>

                <!--Nuevo card body donde va la tabla del stock-->
                <div class="card-body">
                        <!--serial venta-->
                    <div class="form-group row">
                        <label for="descripcion" class="col-md-2 col-form-label text-md-right">{{ __('Serial Venta') }}</label>
                        <div class="col-md-2">
                            <input id="serialVenta" type="number" class="form-control" style="text-align: center" name="serialVenta" readonly value="{{ $tiempo = time() }}">
                        </div>
                        <!--numero venta-->
                        <label for="descripcion" class="col-md-3 col-form-label text-md-right">{{ __('Venta #') }}</label>
                        <div class="col-md-2">
                            <input id="numeroVenta" type="text" class="form-control" style="text-align: center" name="numeroVenta" readonly="true" value="{{ $acum }}">
                        </div>
                    </div>
                
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
                    <div class="card mb-3">
                        <label for="descripcion" class="col-md-2 col-form-label text-md-right"></label>
                        <div class="card-body">
                            <div class="table-responsive">
                                <caption><i class="fas fa-table"></i>&nbsp&nbspSeleccione el producto y la cantidad a vender</caption>
                                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Product</th>
                                            <th>Stock</th>
                                            <th>Costo</th>
                                            <th>Iva?</th>
                                            <th>Category</th>
                                            <th>#C/U</th>
                                            <th>Add</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($producto as $producto)
                                        <tr>
                                            <td><textarea  id="producto{{ $producto->id }}" style="border:0px" readonly value="{{ $producto->nombreProducto }}" disabled  cols="10" rows="2">"{{ $producto->nombreProducto }}"</textarea></td>
                                            @if ($producto->stock > 0)
                                            <td>
                                                <input for="" id="stock1{{ $producto->id }}" readonly  value="{{ $producto->stock }}" style="text-align: center;border:0;width:50px;outline: none;background-color: #dfe;">
                                                <span style="float: right"><label for="">C/U</label></span>
                                            </td>
                                            @else
                                            <td>      
                                                <input  for="" id="stock1{{ $producto->id }}" readonly value="Agotado" class="alert alert-danger"  size="4">
                                            </td>
                                            @endif
                                            <td><input for="" id="costa{{ $producto->id }}" name="costa{{ $producto->id }}" style="text-align: center;border:0;width:70px;outline: none;" readonly value="{{ ($producto->costo*0.19)+$producto->costo }}"></td>
                                            <td><input type="checkbox"  id="ivan{{ $producto->id }}" name="ivan" checked="true" onchange="funcionIva({{ $producto['costo'] }},{{ $producto->id }})" style="width: 5">  </td>
                                            <td >
                                                @if ($producto->category['estado'] == 1)
                                                    {{ $producto->category['categoria'] }}
                                                @else
                                                    No hay categoria disponible
                                                @endif
                                            </td>
                                            <td>
                                                @if ($producto->stock > 0)
                                                    <input id="cantidad{{ $producto->id }}" value="1" type="number" class="form-control" name="cantidadProducto" required style="width: 70px" autofocus="true" min="1" max="{{ $producto->stock }}">
                                                @else
                                                    <input id="cantidad{{ $producto->id }}"  type="text" class="form-control" name="cantidadProducto" style="width: 70px" autofocus="true" placeholder="--" disabled>
                                                @endif
                                            </td> 
                                            <td>
                                                <!--añadir-->
                                                <?php
                                                $iva = $producto->iva;
                                                $stock = $producto->stock;
                                                $precio = $producto->costo;
                                                ?>
                                                    <a href="javascript:void(0)" id="plus{{ $producto->id }}" onclick="funcion('{{ $producto['nombreProducto'] }}',{{ $producto['costo'] }},{{ $producto['stock'] }},{{ $producto->id }})"
                                                    class="btn btn-primary"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>   

                       
                </div>


                <!--subtotal-->
                <div class="form-group row">
                    <label for="descripcion" class="col-md-2 col-form-label text-md-right">{{ __('Subtotal $') }}</label>
                    <div class="col-md-3">
                        <input id="subtotal" type="number" class="form-control" name="subtotal" autofocus="true" readonly>
                    </div>
                    <input type="text" class="col-md-1 form-control" id="ivam" name="ivam" hidden >
                    <!--total-->
                    <label for="descripcion" class="col-md-3 col-form-label text-md-right">{{ __('Total $$') }}</label>
                    <div class="col-md-3">
                        <input id="total" type="number" class="form-control" name="total" autofocus="true" readonly>
                    </div>
                </div>



                <!--cliente-->
                <div class="form-group row">


                </div>

                <!--estado-->
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="form-group" class="form-control">
                            <select name="estado" id="estado" hidden="true">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <input type="text" id="idProducto" name="idProducto" hidden >
                    <input type="text" id="cantidadProducto" name="cantidadProducto" hidden>
 
                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-6">
                            &nbsp&nbsp<button type="submit" class="btn btn-primary"
                                style="align-content: center;">
                                {{ __('Vender') }}
                            </button>&nbsp&nbsp
                            <span style="float:right">
                                <a class="btn btn-primary" href="javascript:void(0)" id="download"><i class="fa fa-file-pdf-o"
                                        aria-hidden="true"></i></a></span>
                        </div>
                        
                    </div>
                    
                </div>
            </div>

            <!--vista previa de factura************************************************************************-->
            <div class="card card-login2 mx-auto mt-2" style="border:1px solid #666" id="pdf">
                <input id="fechaEmision2" type="date" class="form-control" name="fechaEmision2" value="{{ $fecha }}" readonly>
                <div class="card-header" style="text-align: center">Factura S/N &nbsp&nbsp<i class="fa fa-book"
                        aria-hidden="true"></i>&nbsp&nbsp{{ $tiempo = time() }}
                    
                </div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Vendedor') }}</label>
                        <div class="col-md-4">
                            <input id="idUsuario2" type="text" class="form-control" name="idUsuario2" autofocus="true"
                                disabled value="{{ auth()->user()->nombre }} {{ auth()->user()->apellido }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Cliente') }}</label>
                        <div class="col-md-4">
                            <input id="clienter" type="text" class="form-control" name="clienter" autofocus="true" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-md-2 col-form-label text-md-right">Producto</label>
                        <label for="" class="col-md-2 col-form-label text-md-right">cantidad</label>
                        <label for="" class="col-md-2 col-form-label text-md-right">Precio c/u</label>
                        <label for="" class="col-md-2 col-form-label text-md-right">Valor Iva</label>
                        <label for="" class="col-md-2 col-form-label text-md-right">Precio Final</label>
                    </div>

                    <div class="form-group" id="factura" style="align-content: center">
                    </div>

                    <div class="form-group row">
                        <label for="descripcion"
                            class="col-md-2 col-form-label text-md-right">{{ __('Subtotal $') }}</label>
                        <div class="col-md-2">
                            <input id="subtotal2" type="number" class="form-control" name="subtotal" autofocus="true"
                                readonly>
                        </div>
                        <!--iva-->
                        <label for="descripcion" class="col-md-2 col-form-label text-md-right">{{ __('Iva %') }}</label>
                        <div class="col-md-2">
                            <input id="iva2" type="number" class="form-control" name="iva" autofocus="true" readonly>
                        </div>
                        <!--total-->
                        <label for="descripcion" class="col-md-2 col-form-label text-md-right">{{ __('Total $$') }}</label>
                        <div class="col-md-2">
                            <input id="total2" type="number" class="form-control" name="total" autofocus="true" readonly>
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
            var cantidad2 = 0;
            var iProduct =  new Array(); //idProducto
            var cProduct =  new Array(); //cantidadProducto
            var ivaProduct =  new Array(); //cantidadProducto
            var ide= "";
            var iva;
            function fock(event){
                document.getElementById("clienter").setAttribute("value", this.options[this.selectedIndex].text);
            }

            ;

            $(function() { 
                $('#download').click(function() {
                var options = {
                };
                var pdf = new jsPDF('p', 'pt', 'a4');
                pdf.addHTML($("#pdf"), 30, 30, options, function() {
                    nide=document.getElementById("serialVenta").value;
                    pdf.save('C:/Users/alber/Desktop/WebStoreLaravel/resources/facturas/Factura '+nide+'.pdf');
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

            }

            function funcion(productos, costos, cantidades, idd) {
                cont = document.getElementById("cantidad" + idd).value;
                cantidad2 = cantidades - cont
                ide=document.getElementById("producto"+idd).value;
                var cuantoHay = parseInt(cantidades);
                var cuantoVendo = parseInt(cont);
                if (cuantoVendo <= cuantoHay && cuantoVendo != 0) {
                    //document.getElementById("cantidadProducto").setAttribute("s", cProduct);
                    //producto=document.getElementById("producto").innerHTML;
                    //costo=document.getElementById("costo").innerHTML;
                    costosSumados=costos*cont;
                    subtotal = subtotal + costosSumados;
                    var totalStock = cuantoHay - cuantoVendo;
                    //aca se valida que opcion se marco en el check si 1 o 0
                   
                    ibas=document.getElementById("costa"+idd).value;
                    comprobante=costos-ibas
                    
                    if(costos-ibas==0){
                        iva=0;
                        total=total+costosSumados;
                        
                    }else{
                        iva=0.19;
                        var ivaA = (iva * costosSumados) + costosSumados;
                        total = total + ivaA;
                    }
                    
                    //*****************************
                    //Array para cantidad
                    iProduct.push(idd);
                    cProduct.push(cont);
                    ivaProduct.push(iva);
                  
                    document.getElementById("ivan"+idd).disabled=true;
                    document.getElementById("cantidadProducto").setAttribute("value", cProduct);
                    document.getElementById("idProducto").setAttribute("value", iProduct);
                    document.getElementById("ivam").setAttribute("value", ivaProduct);
                   
                    //*****************************

                    document.getElementById("subtotal").setAttribute("value", subtotal);
                    document.getElementById("total").setAttribute("value", total);
                    document.getElementById("stock1" + idd).setAttribute("value", cantidad2);
                    document.getElementById("iva2").setAttribute("value", iva);
                    document.getElementById("total2").setAttribute("value", total);
                    document.getElementById("subtotal2").setAttribute("value", subtotal);
                   
                    
                    //deshabilito la fila debido a que ya exprese la cantidad de ese producto inicial
                    //si requiero cambiar la cantidad debo eliminarlo de la list
                    document.getElementById("cantidad"+idd).disabled=true;
                    document.getElementById("plus"+idd).setAttribute("hidden","true");
                    //href="javascript:void(0)"
                    //variables de la segunda vista

                    //añadir salto de linea
                    var br = document.createElement("br");
                    var img = document.createElement("i");
                    img.className = "fa fa-times";
                    img.setAttribute('aria-hidden', 'true');
                    var capa = document.getElementById("factura");
                    //primero creare el boton de eliminar
                    var boton = document.createElement("a");
                    boton.className = "btn btn-danger ";
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
                    cantidad.innerText = cont;

                    //label para precio unitario
                    var precio = document.createElement("label");
                    precio.className = "col-md-2 col-form-label text-md-right";
                    precio.innerText = costos;

                    //label para iva
                    var ivancio = document.createElement("label");
                    ivancio.className = "col-md-2 col-form-label text-md-right";
                    ivancio.innerText = iva;

                    //label para precio total, todo un cache
                    var precionso = document.createElement("label");
                    precionso.className = "col-md-2 col-form-label text-md-right";
                    precionso.innerText = ((costos*cont)*iva)+(costos*cont);

                    //creo un espacio
                    var espacio = document.createElement("div");
                    espacio.setAttribute("id", espacio);

                    //asignacion al documento html

                    var ope = document.createElement("br");
                    capa.appendChild(espacio);
                    espacio.appendChild(producto);
                    espacio.appendChild(cantidad);
                    espacio.appendChild(precio);
                    espacio.appendChild(ivancio);
                    espacio.appendChild(precionso);
                    espacio.appendChild(boton);
                    espacio.appendChild(ope);

                    function deleteElemento() {
                        var capa = document.getElementById("factura");
                        contar = document.getElementById("stock1" + idd).value;
                        document.getElementById("ivan"+idd).disabled=false;
                        cont = cantidades-contar;
                        //prueba inversa
                    ibas=document.getElementById("costa"+idd).value;
                    comprobante=costos-ibas
                    //volver a la situacion, y revertir el iva
                    pos2 = iProduct.indexOf(idd)
                    cantares=cProduct[pos2]
    
                    if(costos-ibas==0){
                        iva=0;
                        costosSumados=costos*cantares; //estes costos esta por defecto no esta tomando el iva
                        subtotal = subtotal - costosSumados;
                        ivaA = (iva* costosSumados) + costosSumados;
                        total=total-ivaA;
                        
                        
                    }else{
                        iva=0.19;
                        costosSumados=costos*cantares; //estes costos esta por defecto no esta tomando el iva
                        subtotal = subtotal - costosSumados;
                        ivaA = (iva* costosSumados) + costosSumados;
                        total=total-ivaA;
                    }
                        //*******************
                       
                        pos2 = iProduct.indexOf(idd);
                        cProduct.splice(pos2, 1);
                        iProduct.splice(pos2, 1);
                        ivaProduct.splice(pos2, 1);
                        document.getElementById("cantidadProducto").setAttribute("value", cProduct);
                        document.getElementById("idProducto").setAttribute("value", iProduct);
                        document.getElementById("ivam").setAttribute("value", ivaProduct);
                        
                        //asignacion inversa
                    document.getElementById("subtotal").setAttribute("value", subtotal);
                    document.getElementById("total").setAttribute("value", total);
                    document.getElementById("stock1" + idd).setAttribute("value", cantidades);
                    document.getElementById("iva2").setAttribute("value", iva);
                    document.getElementById("total2").setAttribute("value", total);
                    document.getElementById("subtotal2").setAttribute("value", subtotal);
                    
                  
                        //
                        //var borrardiv = capa.lastChild;
                        document.getElementById("plus"+idd).removeAttribute("hidden")
                        document.getElementById("cantidad"+idd).disabled=false;

                        capa.removeChild(espacio);

                    } 
                } else {
                    alert("Operacion Incorrecta PRODUCTO INSUFICIENTE")
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
                    bLengthChange: false,
                    aaSorting: [],
                });

            });
        </script>
    @endsection
