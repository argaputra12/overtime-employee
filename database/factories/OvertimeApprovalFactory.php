<?php

namespace Database\Factories;

use App\Models\Manager;
use App\Models\OvertimeRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OvertimeApproval>
 */
class OvertimeApprovalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'overtime_request_id' => OvertimeRequest::pluck('id')->random(),
            'manager_id' => Manager::pluck('id')->random(),
            'status' => 'pending',
        ];
    }
}