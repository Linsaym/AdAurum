<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('company_fields')->insert([
            [
                'name' => 'name',
            ],
            [
                'name' => 'inn',
            ],
            [
                'name' => 'general_info',
            ],
            [
                'name' => 'ceo',
            ],
            [
                'name' => 'address',
            ],
            [
                'name' => 'phone',
            ],
        ]);
    }
}
