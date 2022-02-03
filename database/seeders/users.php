<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\role;
use DB;
use Hash;
class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $roles = role::where('name','superadmin')->first();
        DB::table('users')->insert([
        [
            'name' => 'superadmin',
            'role_id'=>$roles->id,
            'email'=>'superadmin@gmail.com',
            'password'=>Hash::make('superadmin@gmail.com'),
        ],
        
       ]);
       $roles = role::where('name','admin')->first();
        DB::table('users')->insert([
        [
            'name' => 'admin',
            'role_id'=>$roles->id,
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('admin@gmail.com'),
        ],
        
       ]);

    }
}
