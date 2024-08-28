<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeApproval extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'overtime_request_id',
        'manager_id',
        'status',
        'approved_at',
    ];

    public function overtime_request()
    {
        return $this->belongsTo(OvertimeRequest::class, 'overtime_request_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}