<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // এখানে আপনার DemoBookSeeder কল করা হচ্ছে
        $this->call([
            DemoBookSeeder::class,
        ]);
    }
}
