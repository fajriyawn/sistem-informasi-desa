<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembaruan Status - SIMPANDU</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #0F3A2F;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #0F3A2F;
            margin: 0;
            font-size: 24px;
        }
        .content {
            color: #333;
        }
        .status-badge {
            display: inline-block;
            background-color: #0F3A2F;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            margin: 10px 0;
        }
        .admin-note {
            background-color: #f8f9fa;
            border-left: 4px solid #0F3A2F;
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
        }
        .admin-note h3 {
            margin-top: 0;
            color: #0F3A2F;
            font-size: 16px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SIMPANDU</h1>
            <p>Sistem Informasi dan Monitoring Pengelolaan Pesisir Terpadu</p>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $namaPengguna }}</strong>,</p>
            
            <p>Kami ingin memberitahukan bahwa status {{ $namaModul }} Anda telah diperbarui.</p>
            
            <p><strong>Status Terbaru:</strong></p>
            <div class="status-badge">{{ $statusBaru }}</div>

            @if(!empty($catatanAdmin))
            <div class="admin-note">
                <h3>Catatan dari Administrator:</h3>
                <p>{{ $catatanAdmin }}</p>
            </div>
            @endif

            <p>Terima kasih atas partisipasi Anda dalam sistem SIMPANDU. Jika ada pertanyaan, jangan ragu untuk menghubungi kami.</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} SIMPANDU. Semua hak dilindungi.</p>
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>