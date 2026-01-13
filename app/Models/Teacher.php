<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke User (Milik User siapa?)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
