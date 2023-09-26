<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->truncate();

        $array = [
            ['name' => 'Todo'],
            ['name' => 'Completed'],
        ];

        DB::table('statuses')->insert($array);
    }
}
