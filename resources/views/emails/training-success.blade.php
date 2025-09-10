<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Pelatihan Berhasil</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f9f9f9; padding: 32px;">
    <div style="max-width: 600px; margin: auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #e2e8f0; padding: 32px;">
        <h2 style="color: #2563EB;">Pendaftaran Pelatihan Berhasil</h2>
        <p>Terima kasih telah mendaftar pelatihan melalui SIMPANDU.</p>
        <p>Berikut adalah detail pendaftaran Anda:</p>
        <table style="width: 100%; margin-top: 16px; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px 0; font-weight: bold; width: 180px;">Nama Pendaftar</td>
                <td style="padding: 8px 0;">{{ $trainingData['name'] ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Instansi/Kelompok</td>
                <td style="padding: 8px 0;">{{ $trainingData['organization_name'] ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Topik Pelatihan</td>
                <td style="padding: 8px 0;">{{ $trainingData['training_topic'] ?? '-' }}</td>
            </tr>
        </table>
        <p style="margin-top: 24px;">Kami akan segera menghubungi Anda untuk informasi lebih lanjut terkait pelatihan.</p>
        <p style="margin-top: 32px; color: #6b7280; font-size: 13px;">Salam,<br>SIMPANDU</p>
    </div>
</body>
</html>
