<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningOutcome extends Model
{
    public $timestamps = false;
    protected $fillable = ['student_id', 'learning_goal_id', 'score', 'note', 'created_by'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function goal()
    {
        return $this->belongsTo(LearningGoal::class, 'learning_goal_id');
    }
}
