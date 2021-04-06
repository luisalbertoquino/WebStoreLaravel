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
          <li class="breadcrumb-item active">Modificar Usuario</li>
        </ol>
        <div class="card card-login mx-auto mt-2" style="border:1px solid #666"> 
            <div class="card-header" style="text-align: center;font-size:20px; color:#34495E ;font-weight: italic;">Modificar Usuario Seleccionado &nbsp&nbsp<i class="fa fa-address-book" aria-hidden="true"></i></div>
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
    
            <form method="POST" action="/user/{{$piola}}">
                @method('PATCH')
                {{csrf_field()}}

        
     
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                    <div class="col-md-8">
                        <input id="nombre" type="text" class="form-control " name="nombre" required  value="{{$user->nombre}}" autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>
                    <div class="col-md-8">
                        <input id="apellido" type="text" class="form-control" name="apellido"  required  value="{{$user->apellido}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-left">{{ __('Document') }}</label>
                    <div class="col-md-8">
                        <select name="idDocumento" id="idDocumento" class="form-control" value="{{$user->idDocumento}}">
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
                        <input id="numeroDocumento" type="number" class="form-control" name="numeroDocumento"  required value="{{$user->idDocumento}}">
                    </div>
                </div>

    
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>
    
                    <div class="col-md-8">
                        <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}">
    
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
                        <input id="telefono" type="number" class="form-control" name="telefono" value="{{$user->telefono}}">
                    </div>
                </div>
    
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>
    
                    <div class="col-md-8">
                        <input id="direccion" type="text" class="form-control" name="direccion" required value="{{$user->direccion}}">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                    <div class="col-md-8">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
    
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Asigne un Rol') }}</label>
                        <div class="col-md-8">
                            <select class=" js-example-theme-single form-control" data-live-search="true" name="role" id="role">
                                <option value="">Select Role...</option>
                                @foreach($roles as $role)
                                    <option data-role-id="{{  $role->id  }}" data-role-slug="{{  $role->slug  }}" value="{{ $role->id }}" {{ $user->roles->isEmpty() || $role->nombre != $userRol->nombre ? "": "Selected"}}>{{ $role->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>

                <div>
                    <label for="roles" class="col-md-4 col-form-label text-md-right">Selecciona los permisos</label>
                    <div id="permissions_checkbox_list" class="col-md-8"></div>
                </div>

                @if($user->permissions->isNotEmpty())
                    @if($rolePermissions != null)
                        <div id="user_permissions_box" class="form-group row">
                            <label for="roles" class="col-md-4 col-form-label text-md-right">Permisos Anteriores</label>
                            <div id="user_permissions_checkbox_list" class="col-md-8">
                                @foreach ($rolePermissions as $permission)
                                <div class="custom-control custom-checkbox" class="col-md-8">
                                    <input class="custom-control-input" type="checkbox" name="permissions[]" id="{{$permission->slug}}" value="{{$permission->id}}" {{ in_array($permission->id,$userPermissions->pluck('id')->toArray() ) ? 'checked="checked"' : ''}}>
                                    <label for="{{$permission->slug}}" class="custom-control-label" for="{{$permission->slug}}">{{$permission->nombre}}</label>
                                </div>
                                @endforeach
                            </div> 
                        </div>
                    @endif
                @endif

                <div class="form-group row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <select name="estado" id="estado" class="form-control" hidden>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                </div>
                </div>
    
             
                <div class="form-group pt-2">
                        <a href="{{url()->previous()}}" class="btn btn-danger">Regresar</a>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Modificar Usuario') }}
                        </button>
                    </div>
    
            </form>

            @section('js_user_page')
            <script>
                $(document).ready(function() {
                    var premissions_box = $('#permissions_box');
                    var permissions_checkbox_list = $('#permissions_checkbox_list');
                    var user_permissions_box = $('#user_permissions_box');

                    premissions_box.hide(); //hide all boxes
                    
                    $('#role').on('change', function(){
                        var role = $(this).find(':selected');
                        var role_id = role.data('role-id');
                        var role_slug = role.data('role-slug');

                        permissions_checkbox_list.empty();
                        user_permissions_box.empty();

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
                                        '<div class="custom-control custom-checkbox col-md-8">'+
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
            <!-- /.container-fluid -->
      
            <!-- Sticky Footer -->
      </div>
          </div>
          <!-- /.content-wrapper -->
      
      @endsection
      @endsection