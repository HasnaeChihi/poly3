<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $User=User::create(['name' =>'Admin',
        'email' =>'admin@gmail.com',
        'password' => Hash::make('admin')]);
        $User->roles()->attach(Role::first());
         
    }
}
