<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date',
        'start_time',
        'end_time',
        'duration',
        'reason',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function overtime_approvals()
    {
        return $this->hasMany(OvertimeApproval::class);
    }
}