<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nis',
        'nik',
        'name',
        'gender',
        'class_name',
        'birth_place',
        'birth_date',
        'address',
        'guardian_id',
        'status',
        'father_name',
        'mother_name'
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function guardian()
    {
        return $this->belongsTo(User::class, 'guardian_id');
    }

    public function learningOutcomes()
    {
        return $this->hasMany(LearningOutcome::class);
    }

    public function teacherNotes()
    {
        return $this->hasMany(TeacherNote::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
