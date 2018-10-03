<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\User::class, 50)->create();
        DB::table('users')->insert([
            'name' => 'Cyro Dubeux',
            'email' => 'xorycx@gmail.com',
            'password' => Hash::make('-%O1r2y3c487-%'),
            'api_token' => str_random(32),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}