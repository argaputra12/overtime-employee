<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Manager;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Manager::factory()->count(10)->create();

        $manager = User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@manager.com',
            'password' => bcrypt('password'),
        ]);

        Manager::factory()->create([
            'user_id' => $manager->id,
            'department_id' => 1
        ]);
    }
}
