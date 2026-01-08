<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningGoal extends Model
{
    public $timestamps = false; // Karena di DB cuma ada created_at manual (opsional)
    // Jika ingin pakai timestamps standard Laravel, hapus baris di atas

    protected $fillable = ['title', 'description', 'class_name', 'created_by'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function outcomes()
    {
        return $this->hasMany(LearningOutcome::class);
    }
}
