<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        if ((new User)->where('email', 'jaime@jaimemazo.com')->doesntExist()) {
            $user = User::create([
                'name' => 'Administrador',
                'email' => 'jaime@jaimemazo.com',
                'password' => bcrypt('mazomazo'),
            ]);
        }
        $this->call(PermissionTableSeeder::class);
        $permissions = Permission::pluck('id', 'id')->all();


        $roleadmin->syncPermissions($permissions);
        $user->assignRole([$roleadmin->id]);
        $this->call(AirlinesTableSeeder::class);
        $this->call(DestinationsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);

    }
}
