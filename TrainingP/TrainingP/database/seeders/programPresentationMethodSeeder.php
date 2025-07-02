<?php

namespace Database\Seeders;

use App\Models\programPresentationMethod;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class programPresentationMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $methods = [
            ['name' => 'حضوري', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'عن بُعد (أونلاين)', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'هجينة (حضوري + عن بُعد)', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'تسجيل مسبق (مسجّل)', 'created_at' => $now, 'updated_at' => $now],
        ];

        programPresentationMethod::insert($methods);
    }
}
