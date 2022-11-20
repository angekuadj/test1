<?php

namespace Database\Seeders;

use App\Models\Emploi;
use Illuminate\Database\Seeder;

class EmploiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Emploi::factory()
            ->count(5)
            ->create();
    }
}
