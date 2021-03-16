<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=new User();
        $user->name='Codersfree';
        $user->email='vhaf@codersfree.com';
        $user->password=Hash::make('contraseña');
        if(env('APP_ENV') == 'production'){
            $user->email='shjdh@codersfree';
            $user->password=Hash::make('jdww7dw763udhwudw6w76d7d6w7duwddwuydh');
        }
        $user->assignRole('admin');
        $user->save();

        User::factory(2)->create();
    }
}
