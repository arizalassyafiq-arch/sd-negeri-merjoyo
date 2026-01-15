<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteReply extends Model
{
    protected $fillable = ['teacher_note_id', 'user_id', 'reply_content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function note()
    {
        return $this->belongsTo(TeacherNote::class, 'teacher_note_id');
    }
}
