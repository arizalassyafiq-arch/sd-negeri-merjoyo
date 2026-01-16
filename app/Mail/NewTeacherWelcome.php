<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewTeacherWelcome extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;

    // Terima data user & password default lewat constructor
    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Selamat Datang di Sistem Sekolah - Akses Akun Guru',
        );
    }

    public function content(): Content
    {
        // Kita akan buat view ini di langkah selanjutnya
        return new Content(
            view: 'emails.teachers.welcome',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
