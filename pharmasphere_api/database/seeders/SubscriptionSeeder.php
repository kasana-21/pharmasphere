<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subscriptions')->insert([
            [
                'user_id' => 2,
                'plan' => 'monthly',
                'expires_at' => now()->addMonth(),
            ],
            [
                'user_id' => 4,
                'plan' => 'monthly',
                'expires_at' => now()->addMonth(),
            ],
            [
                'user_id' => 5,
                'plan' => 'monthly',
                'expires_at' => now()->addMonth(),
            ],
        ]);
    }
}
