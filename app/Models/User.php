<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // Relasi: User sebagai Guru membuat Learning Goals
    public function learningGoals()
    {
        return $this->hasMany(LearningGoal::class, 'created_by');
    }

    // Relasi: User sebagai Penulis Artikel
    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    // Relasi: User sebagai Wali (punya banyak siswa)
    public function students()
    {
        return $this->hasMany(Student::class, 'guardian_id');
    }
}
