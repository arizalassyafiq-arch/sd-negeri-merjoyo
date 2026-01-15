<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherNote extends Model
{
    public $timestamps = false;
    protected $fillable = ['student_id', 'teacher_id', 'note'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function replies()
    {
        return $this->hasMany(NoteReply::class)->orderBy('created_at', 'asc'); // Urut dari lama ke baru (chat style)
    }
}
