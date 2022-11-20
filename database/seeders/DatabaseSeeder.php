<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name'=>'SuperAdmin'
        ]);
        DB::table('roles')->insert([
            'name'=>'Admin'
        ]);
        DB::table('roles')->insert([
            'name'=>'User'
        ]);
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

        $this->call(ClasseSeeder::class);
        $this->call(EmploiSeeder::class);
        $this->call(ProfSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SalleSeeder::class);
        $this->call(UserSeeder::class);
    }
}
