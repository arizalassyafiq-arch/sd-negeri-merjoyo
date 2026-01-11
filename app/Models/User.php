<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'avatar',
        'status',
        'last_login_at', // Tambahkan ini
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
            'last_login_at' => 'datetime',
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


    protected static function boot()
    {
        parent::boot();

        // Event 'deleting' dipicu tepat sebelum data dihapus dari DB
        static::deleting(function ($user) {
            if ($user->avatar) {
                // Hapus file dari folder storage/app/public
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->avatar);
            }
        });
    }
}
