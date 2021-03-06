<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Encargado;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        if ((new Role)->where('name', 'admin')->doesntExist()) {
            $roleadmin = Role::create([
                'id' => 1,
                'name' => 'admin'
            ]);
        }

        if ((new Role)->where('name', 'operator')->doesntExist()) {
            Role::create([
                'id' => 2,
                'name' => 'operator'
            ]);
        }

        if ((new Role)->where('name', 'supervisor')->doesntExist()) {
            $rolesuper = Role::create([
                'id' => 3,
                'name' => 'supervisor'
            ]);
        }

        if ((new User)->where('email', 'jmazo@innovacodespa.com')->doesntExist()) {
            $user = User::create([
                'name' => 'Administrador',
                'email' => 'jmazo@innovacodespa.com',
                'password' => bcrypt('innovacodespa2019'),
            ]);
        }
        if ((new User)->where('email', 'smunoz@innovacodespa.com')->doesntExist()) {
            $user2 = User::create([
                'name' => 'Administrador',
                'email' => 'smunoz@innovacodespa.com',
                'password' => bcrypt('innovacodespa2019'),
            ]);
        }

        $this->call(PermissionTableSeeder::class);
        $permissions = Permission::pluck('id', 'id')->all();

        $permisionsupervisor = Permission::where('name', 'like', 'encargado%')
            ->orWhere('name', 'like', 'producto%')->get()->pluck('id', 'id');

        $rolesuper->syncPermissions($permisionsupervisor);
        $roleadmin->syncPermissions($permissions);
        $user->assignRole([$roleadmin->id]);
        $user2->assignRole([$roleadmin->id]);

        $this->call(AirlinesTableSeeder::class);
        $this->call(DestinationsTableSeeder::class);

        if (env('APP_ENV') == 'local' || env('APP_ENV') == 'develepment') {
            $this->call(ProductsTableSeeder::class);
            if ((new Encargado)->where('rut', '24544936-4')->doesntExist()) {
                Encargado::create([
                    'rut' => '24544936-4',
                    'nombre' => 'jaime mazo',
                ]);
            }
        }
    }
}
