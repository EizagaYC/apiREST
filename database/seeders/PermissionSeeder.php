<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        # CLEAR TABLE'S
    	DB::statement('SET foreign_key_checks=0');
	    	DB::table('role_user')->truncate();
	    	DB::table('permission_role')->truncate();
	    	Permission::truncate();
	    	Role::truncate();
	    	User::truncate();
    	DB::statement('SET foreign_key_checks=1');

    	# CREATE USER 
    	$user = User::create([
            'name' 		=> 'Yoangel Eizaga',
            'email' 	=>  'yoangeleizaga@gmail.com',
            'age' 		=>  22,
            'birtday' 	=>  '1999-05-24',
            'sex' 		=>  'M',
            'dni' 		=>  51765234,
            'address' 	=>  'Barquisimeto edo Lara',
            'country' 	=>  'VE',
            'phone' 	=>  04125033750,
            'password' 	=> Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);

        # CREATE ROLES 
    	$admin = Role::create([
        	'name'		=> 'Admin',
        	'full-access' 	=> 'yes'
        ]);

        $visitor = Role::create([
        	'name'		=> 'Visitor',
        	'full-access' 	=> 'no'
        ]);

        # ASSIGN ROLE TO USER 
        $user->roles()->sync([$admin->id]);

        # PERMISSIONS ROLES
	    $permission = Permission::create([
	        'name'          => 'Crear Role'
	    ]);

		$permission = Permission::create([
	        'name'          => 'Listar Role'
	    ]);

	    $permission = Permission::create([
	        'name'          => 'Modificar Role'
	    ]);

	    $permission = Permission::create([
	        'name'          => 'Eliminar Role'
	    ]);

	    $permission = Permission::create([
	        'name'          => 'Ver Detalles de Role'
	    ]);

		# PERMISSIONS USER
	    $permission = Permission::create([
	        'name'          => 'Crear Usuario'
	    ]);

		$permission = Permission::create([
	        'name'          => 'Listar Usuario'
	    ]);

		# ASSIGN PERMISSION TO ROLE
	    $permission_visitor[] = $permission->id ;

	    $permission = Permission::create([
	        'name'          => 'Modificar Usuario'
	    ]);

	    $permission = Permission::create([
	        'name'          => 'Eliminar Usuario'
	    ]);

	    $permission = Permission::create([
	        'name'          => 'Ver Detalles de Usuario'
	    ]);

	    # ASSIGN PERMISSION TO ROLE
	    $permission_visitor[] = $permission->id ;

	    # ASSIGN PERMISSION TO ROLE VISITOR 
        $visitor->permissions()->sync( $permission_visitor );

	}
}
