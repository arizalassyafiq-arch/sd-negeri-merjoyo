<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttendanceSummary extends Model
{
    protected $fillable = [
        'student_id',
        'present',
        'sick',
        'permit',
        'absent',
        'updated_by',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
