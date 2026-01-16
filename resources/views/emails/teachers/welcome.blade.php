<!DOCTYPE html>
<html>

<head>
    <title>Selamat Datang</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">

    <h2>Halo, Bapak/Ibu {{ $user->name }}</h2>

    <p>Selamat datang! Akun Anda telah didaftarkan di Sistem Informasi Sekolah EduAdmin.</p>

    <p>Berikut adalah detail login Anda:</p>

    <div style="background: #f4f4f4; padding: 15px; border-radius: 8px; display: inline-block;">
        <p style="margin: 0;"><strong>Email:</strong> {{ $user->email }}</p>
        <p style="margin: 5px 0 0;"><strong>Password Sementara:</strong> <code
                style="background: #ddd; padding: 2px 5px; border-radius: 4px;">{{ $password }}</code></p>
    </div>

    <p style="color: red; font-weight: bold;">PENTING:</p>
    <p>Demi keamanan, mohon segera login dan ganti password Anda melalui menu <strong>Pengaturan Profil</strong>.</p>

    <p>Silakan login melalui tombol di bawah ini:</p>

    <a href="{{ route('login') }}"
        style="background-color: #4F46E5; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">Login
        Sekarang</a>

    <br><br>
    <p>Terima kasih,<br>Tim IT Sekolah</p>

</body>

</html>
