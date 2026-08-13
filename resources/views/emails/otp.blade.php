<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: Arial, sans-serif; background: #f9fafb; padding: 32px; margin: 0;">
    <div style="max-width: 480px; margin: 0 auto; background: #ffffff; border-radius: 16px; padding: 32px; text-align: center;">
        <h1 style="color: #dc2626; font-size: 24px; margin-bottom: 4px;">La-Primera</h1>
        <p style="color: #6b7280; margin-bottom: 24px;">Kode verifikasi untuk {{ $userName }}</p>

        <div style="background: #fee2e2; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
            <span style="font-size: 36px; font-weight: bold; letter-spacing: 8px; color: #991b1b;">
                {{ $otpCode }}
            </span>
        </div>

        <p style="color: #374151; font-size: 14px; line-height: 1.6;">
            Masukkan kode ini di halaman verifikasi untuk menyelesaikan pendaftaran akun kamu.
            Kode ini berlaku selama <strong>10 menit</strong>.
        </p>
        <p style="color: #9ca3af; font-size: 12px; margin-top: 24px;">
            Kalau kamu tidak merasa mendaftar di La-Primera, abaikan email ini.
        </p>
    </div>
</body>
</html>