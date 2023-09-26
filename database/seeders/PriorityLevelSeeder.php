<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PriorityLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('priority_levels')->truncate();

        $array = [
            ['name' => 'Urgent'],
            ['name' => 'High'],
            ['name' => 'Normal'],
            ['name' => 'Low']
        ];

        DB::table('priority_levels')->insert($array);
    }
}
