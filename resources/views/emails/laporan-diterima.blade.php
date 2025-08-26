<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Diterima - SIMPANDU</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }
        .tracking-code {
            background-color: #e8f5e8;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 25px 0;
            border-left: 4px solid #27ae60;
        }
        .tracking-code h2 {
            color: #27ae60;
            margin: 0;
            font-size: 24px;
        }
        .content {
            margin: 20px 0;
            text-align: justify;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Terima Kasih Telah Melapor!</h1>
        </div>

        <div class="content">
            <p>Halo,</p>
            
            <p>Terima kasih telah menyampaikan laporan Anda melalui Sistem Informasi Manajemen Pelayanan Administrasi Desa (SIMPANDU). Kami dengan senang hati menginformasikan bahwa laporan Anda telah berhasil diterima dan akan segera ditindaklanjuti oleh tim kami.</p>

            <div class="tracking-code">
                <p><strong>Kode Tracking Laporan Anda:</strong></p>
                <h2><strong>{{ $kodeTracking }}</strong></h2>
                <p><em>Simpan kode ini untuk melacak status laporan Anda</em></p>
            </div>

            <p>Dengan kode tracking di atas, Anda dapat memantau perkembangan laporan Anda kapan saja. Tim kami akan meninjau laporan Anda dan memberikan tanggapan yang sesuai dalam waktu yang wajar.</p>

            <p>Jika Anda memiliki pertanyaan lebih lanjut atau memerlukan informasi tambahan, jangan ragu untuk menghubungi kami.</p>
        </div>

        <div class="footer">
            <p>Salam hormat,</p>
            <p><strong>Tim SIMPANDU</strong></p>
            <p><em>Sistem Informasi Manajemen Pelayanan Administrasi Desa</em></p>
        </div>
    </div>
</body>
</html>
