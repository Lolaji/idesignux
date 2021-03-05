<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => "Ajibola Salami",
                'email' => 'ayo.lolade@gmail.com',
                'password' => Hash::make('ajibola1'),
                'is_admin' => true,
                'verified_at' => now(),
                'created_at' => now()
            ]
        ]);
    }
}
