<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorporationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coporations')->insert([
            ['name' => 'Tech Innovations'],
            ['name' => 'Global Solutions'],
            ['name' => 'Future Enterprises'],
            ['name' => 'Smart Systems'],
            ['name' => 'Pioneer Industries'],
        ]);

    }
}
