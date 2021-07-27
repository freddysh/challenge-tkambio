<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=new User();
        $admin->name='Admin';
        $admin->email='admin@gmail.com';
        $admin->password=bcrypt('admin123456');
        $admin->save();
        $admin->assignRole('admin');

        $operador=new User();
        $operador->name='Operador';
        $operador->email='operador@gmail.com';
        $operador->password=bcrypt('ope123456');
        $operador->save();
        $operador->assignRole('operador');
    }
}
