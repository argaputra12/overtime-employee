<?php

namespace Database\Seeders;

use App\Models\OvertimeRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OvertimeRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OvertimeRequest::factory(10)->create();
    }
}