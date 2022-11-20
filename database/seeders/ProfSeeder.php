<?php

namespace Database\Seeders;

use App\Models\Prof;
use Illuminate\Database\Seeder;

class ProfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prof::factory()
            ->count(5)
            ->create();
    }
}
