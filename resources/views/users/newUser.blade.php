@extends('layouts.app')
@section('content')

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/home">Home</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="/user">Usuarios</a>
          </li>
          <li class="breadcrumb-item active">Nuevo Usuario</li>
        </ol>
        <div class="card card-login mx-auto mt-2" style="border:1px solid #666"> 
            
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
    
    <div class="container"  >
       
          <div class="card-header" style="text-align: center">Registrar Nuevo Usuario - StoreSystem FJ&nbsp&nbsp&nbsp<i class="fa fa-spinner" aria-hidden="true"></i></div>
          <div class="card-body">
            <form method="POST" action="/user">
                @csrf
     
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                    <div class="col-md-8">
                        <input id="nombre" type="text" class="form-control " name="nombre" required  autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>
                    <div class="col-md-8">
                        <input id="apellido" type="text" class="form-control" name="apellido"  required >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-left">{{ __('Document') }}</label>
                    <div class="col-md-8">
                        <select name="idDocumento" id="idDocumento" class="form-control">
                            @foreach ($documento as $documento)
                            @if ($documento->estado==1){
                            <option value={{$documento->id}}>{{$documento->tipoDocumento}}</option>
                             }
                           @endif
                            @endforeach
                        </select> 
                    </div>
                </div>  

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('N° Id') }}</label>
                    <div class="col-md-8">
                        <input id="numeroDocumento" type="number" class="form-control" name="numeroDocumento"  required autofocus>
                    </div>
                </div>

    
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
    
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>
                    <div class="col-md-8">
                        <input id="telefono" type="number" class="form-control" name="telefono" >
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>
    
                    <div class="col-md-8">
                        <input id="direccion" type="text" class="form-control" name="direccion" required >
                    </div>
                </div>
 
                <div class="form-group row">
                    <label for="usuario" class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}</label>
    
                    <div class="col-md-8">
                        <input id="usuario" type="text" class="form-control" name="usuario" required autocomplete="new-password">
                    </div>
                </div>

                

                <input id="hftest" type="text" class="form-control" name="hftest" autofocus="true" readonly hidden>


                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm"  hidden class="col-md-4 col-form-label text-md-right">{{ __('Seleccione Estado') }}</label>
                    <div class="col-md-8">
                            <select name="estado" id="estado" class="form-control" hidden>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                </div>
                </div>
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-5 col-form-label text-md-right">{{ __('Asigne un Rol') }}</label>
                        <select class="js-example-theme-single form-control" data-live-search="true" name="role" id="role">
                            <option value="">Select Role...</option>
                            @foreach($roles as $role)
                                <option data-role-id="{{  $role->id  }}" data-role-slug="{{  $role->slug  }}" value="{{ $role->id }}">{{ $role->nombre }}</option>
                            @endforeach
                        </select>
                </div>

                <div id="permissions_box">
                   <label for="roles">Select Permissions</label>
                    <div id="permissions_checkbox_list">  
                    </div>
                </div>

                <div class="form-group pt-2">
                    <input type="submit" class="btn btn-primary" value="Registrar Usuario">
                </div>
            </form>

            @section('js_user_page')
           

            <script>
                function fock(event){
                    var values = $('#role_permisions2').val();
                    document.getElementById("hftest").setAttribute("value",values);
            
                }
            
            
                $(document).ready(function() {
                    var premissions_box = $('#permissions_box');
                    var permissions_checkbox_list = $('#permissions_checkbox_list');

                    //premissions_box.hide(); //hide all boxes
                    
                    $('#role').on('change', function(){
                        var role = $(this).find(':selected');
                        var role_id = role.data('role-id');
                        var role_slug = role.data('role-slug');

                        permissions_checkbox_list.empty();

                            $.ajax({
                                url:"/user/create",
                                method:'get',
                                dataType: 'json',
                                data:{
                                    role_id: role_id,
                                    role_slug: role_slug,
                                }
                            }).done(function(data){
                                console.log(data);
                                //permissions_box.show();
                                // permissions_checkbox_list.empty();


                                $.each(data, function(index, element){
                                    $(permissions_checkbox_list).append(
                                        '<div class="custom-control custom-checkbox">'+
                                        '<input class="custom-control-input" type="checkbox" name="permissions[]" id="'+element.slug+'"value="'+element.id+'">'+
                                        '<label class="custom-control-label" for="'+element.slug+'">'+element.nombre+'</label>'+
                                        '</div>'
                                    );
                                });
                            });

                    });
                    $('.js-example-responsive').select2({theme:"classic"});
                    $('.js-example-theme-single').select2({theme:"classic"});

                });
            
                
              </script>
                @section('css_role_page')
                <link rel="stylesheet" href="/css/bootstrap-tagsinput.css">
                @endsection
            
                @section('js_role_page')
                  <script src="/js/bootstrap-tagsinput.js"></script>
                @endsection
        
          </div>
      
      </div>        


          </div>

    </div>
            <!-- /.container-fluid -->
      
            <!-- Sticky Footer -->
      
          </div>
          <!-- /.content-wrapper -->
      
      @endsection
      @endsection