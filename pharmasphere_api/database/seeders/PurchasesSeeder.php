<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('purchases')->insert([
            ['user_id' => 1,'drug_id' => 1],
            ['user_id' => 1, 'drug_id' => 2],
            ['user_id' => 1, 'drug_id' => 3],
            ['user_id' => 1, 'drug_id' => 4],
            ['user_id' => 1, 'drug_id' => 5],
            ['user_id' => 1, 'drug_id' => 6],
            ['user_id' => 2, 'drug_id' => 7],
            ['user_id' => 2, 'drug_id' => 8],
            ['user_id' => 2, 'drug_id' => 9],
            ['user_id' => 2, 'drug_id' => 10],
            ['user_id' => 2, 'drug_id' => 11],
            ['user_id' => 2, 'drug_id' => 12],
            ['user_id' => 3, 'drug_id' => 13],
            ['user_id' => 3, 'drug_id' => 14],
            ['user_id' => 3, 'drug_id' => 15],
            ['user_id' => 3, 'drug_id' => 16],
            ['user_id' => 3, 'drug_id' => 17],
            ['user_id' => 3, 'drug_id' => 18],
            ['user_id' => 4, 'drug_id' => 19],
            ['user_id' => 4, 'drug_id' => 20],
            ['user_id' => 4, 'drug_id' => 21],
        ]);
    }
}
