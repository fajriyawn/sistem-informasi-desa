<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengajuan Rehabilitasi Diterima</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f9f9f9; padding: 32px;">
    <div style="max-width: 600px; margin: auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #e2e8f0; padding: 32px;">
        <h2 style="color: #16a34a;">Pengajuan Rehabilitasi Diterima</h2>
        <p>Terima kasih telah mengajukan proposal rehabilitasi melalui SIMPANDU.</p>
        <p>Berikut adalah detail pengajuan Anda:</p>
        <table style="width: 100%; margin-top: 16px; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px 0; font-weight: bold; width: 180px;">Nama Pengaju</td>
                <td style="padding: 8px 0;">{{ $proposalData['name'] ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Lokasi</td>
                <td style="padding: 8px 0;">{{ $proposalData['location'] ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Deskripsi</td>
                <td style="padding: 8px 0;">{{ $proposalData['description'] ?? '-' }}</td>
            </tr>
        </table>
        <p style="margin-top: 24px;">Tim kami akan segera meninjau proposal Anda dan menghubungi Anda untuk proses selanjutnya.</p>
        <p style="margin-top: 32px; color: #6b7280; font-size: 13px;">Salam,<br>SIMPANDU</p>
    </div>
</body>
</html>
