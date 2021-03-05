<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\usuario;
use Illuminate\Support\Facades\Validator;


class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $permissions_array=[];
        //categoria        create_ventas edit_ventas delete_ventas view_productos
        array_push($permissions_array,Permission::create(['name' => 'create_category']));
        array_push($permissions_array,Permission::create(['name' => 'edit_category']));
        array_push($permissions_array,Permission::create(['name' => 'delete_category']));
        array_push($permissions_array,Permission::create(['name' => 'view_category']));
        //productos
        array_push($permissions_array,Permission::create(['name' => 'create_productos']));
        array_push($permissions_array,Permission::create(['name' => 'edit_productos']));
        array_push($permissions_array,Permission::create(['name' => 'delete_productos']));
        $verProducto=Permission::create(['name' => 'view_productos']);
        array_push($permissions_array,$verProducto);
        //ventas
        array_push($permissions_array,Permission::create(['name' => 'create_ventas']));
        array_push($permissions_array,Permission::create(['name' => 'edit_ventas']));
        array_push($permissions_array,Permission::create(['name' => 'delete_ventas']));
        array_push($permissions_array,Permission::create(['name' => 'view_ventas']));
        //compras
        array_push($permissions_array,Permission::create(['name' => 'create_compras']));
        array_push($permissions_array,Permission::create(['name' => 'edit_compras']));
        array_push($permissions_array,Permission::create(['name' => 'delete_compras']));
        array_push($permissions_array,Permission::create(['name' => 'view_compras']));
        //clientes
        array_push($permissions_array,Permission::create(['name' => 'create_clientes']));
        array_push($permissions_array,Permission::create(['name' => 'edit_clientes']));
        array_push($permissions_array,Permission::create(['name' => 'delete_clientes']));
        array_push($permissions_array,Permission::create(['name' => 'view_clientes']));
        //proveedores
        array_push($permissions_array,Permission::create(['name' => 'create_proveedores']));
        array_push($permissions_array,Permission::create(['name' => 'edit_proveedores']));
        array_push($permissions_array,Permission::create(['name' => 'delete_proveedores']));
        array_push($permissions_array,Permission::create(['name' => 'view_proveedores']));
        //usuarios
        array_push($permissions_array,Permission::create(['name' => 'create_usuarios']));
        array_push($permissions_array,Permission::create(['name' => 'edit_usuarios']));
        array_push($permissions_array,Permission::create(['name' => 'delete_usuarios']));
        array_push($permissions_array,Permission::create(['name' => 'view_usuarios']));
        //informes
        array_push($permissions_array,Permission::create(['name' => 'create_informes']));
        array_push($permissions_array,Permission::create(['name' => 'edit_informes']));
        array_push($permissions_array,Permission::create(['name' => 'delete_informes']));
        array_push($permissions_array,Permission::create(['name' => 'view_informes']));
        //opciones del sistema
        array_push($permissions_array,Permission::create(['name' => 'create_opciones']));
        array_push($permissions_array,Permission::create(['name' => 'edit_opciones']));
        array_push($permissions_array,Permission::create(['name' => 'delete_opciones']));
        array_push($permissions_array,Permission::create(['name' => 'view_opciones']));


        $superAdminRole = Role::create(['name' => 'super_admin']);
        $superAdminRole->syncPermissions($permissions_array); //array muchos permisos
        $viewProducts = Role::create(['name' => 'demo']);
        $viewProducts->givePermissionTo($verProducto);

        $userSuperAdmin = usuario::create([
            'nombre'=>'Super',
            'apellido'=>'Usuario',
            'idDocumento'=>'1',
            'numeroDocumento'=>'100000',
            'email'=>'test@prueba.com',
            'telefono'=>'100000',
            'direccion'=>'1000000',
            'usuario'=>'admin',
            'password'=>bcrypt('admin'),
            'estado'=>'1'
        ]);
        $userSuperAdmin->assignRole('super_admin');

        $userDemo = usuario::create([
            'nombre'=>'Demo',
            'apellido'=>'Demo',
            'idDocumento'=>'1',
            'numeroDocumento'=>'100001',
            'email'=>'demo@prueba.com',
            'telefono'=>'100000',
            'direccion'=>'1000000',
            'usuario'=>'demo',
            'password'=>bcrypt('admin'),
            'estado'=>'1'
        ]);
        $userDemo->assignRole('demo');

        $userInvalid = usuario::create([
            'nombre'=>'Limitado',
            'apellido'=>'SoloHome',
            'idDocumento'=>'1',
            'numeroDocumento'=>'100002',
            'email'=>'limitado@prueba.com',
            'telefono'=>'100000',
            'direccion'=>'1000000',
            'usuario'=>'admino',
            'password'=>bcrypt('admin'),
            'estado'=>'1'
        ]);

    }
}
