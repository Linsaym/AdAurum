<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'name' => 'AdAurum',
                'inn' => '1234567890',
                'general_info' => 'General information about Company One.',
                'ceo' => 'John Doe',
                'address' => '123 Main St, City One, Country',
                'phone' => '+1-555-1234'
            ],
            [
                'name' => 'BusySpace',
                'inn' => '2345678901',
                'general_info' => 'General information about Company Two.',
                'ceo' => 'Jane Smith',
                'address' => '456 Elm St, City Two, Country',
                'phone' => '+1-555-5678'
            ],
            [
                'name' => 'MediumStatus',
                'inn' => '3456789012',
                'general_info' => 'General information about Company Three.',
                'ceo' => 'Jim Brown',
                'address' => '789 Oak St, City Three, Country',
                'phone' => '+1-555-9012'
            ],
            [
                'name' => 'RealityOne',
                'inn' => '4567890123',
                'general_info' => 'General information about Company Four.',
                'ceo' => 'Lucy Green',
                'address' => '101 Pine St, City Four, Country',
                'phone' => '+1-555-3456'
            ]
        ]);
    }
}
