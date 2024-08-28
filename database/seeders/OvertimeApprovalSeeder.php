<?php

namespace Database\Seeders;

use App\Models\OvertimeApproval;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OvertimeApprovalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OvertimeApproval::factory()->count(10)->create();
    }
}