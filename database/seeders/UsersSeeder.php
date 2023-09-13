<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Users;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          ['first_name'=>'Maria', 'last_name' =>'Mariot', 'login'=>'mmariot', 'email'=>'mmariot@gmail.com','password'=>'Kotki123','address'=>'Starowiejska 34 Gdynia','zip_code'=>'45-746','is_admin'=>true],

    ]);
        
    }
}
