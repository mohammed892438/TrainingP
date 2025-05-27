<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('certificates')->insert([
            ['name' => 'Microsoft Certified: Azure Fundamentals', 'issuer' => 'Microsoft'],
            ['name' => 'Google Cloud Associate Engineer', 'issuer' => 'Google'],
            ['name' => 'AWS Certified Solutions Architect', 'issuer' => 'Amazon Web Services'],
            ['name' => 'PMP (Project Management Professional)', 'issuer' => 'PMI'],
            ['name' => 'Certified Ethical Hacker (CEH)', 'issuer' => 'EC-Council'],
        ]);
    }
}