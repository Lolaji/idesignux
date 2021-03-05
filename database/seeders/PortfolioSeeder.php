<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('portfolios')->insert([
            [
                'title' => 'Vunyx Studio',
                'description' => 'We develop a well functioning studio tool.',
                'content' => 'We develop a well functioning studio tool.'
            ],
            [
                'title' => 'Lucruitive',
                'description' => 'We develop a well functioning studio tool.',
                'content' => 'We develop a well functioning studio tool.'
            ],
            [
                'title' => 'EC Business',
                'description' => 'We develop a well functioning studio tool.',
                'content' => 'We develop a well functioning studio tool.'
            ],
        ]);
    }
}
