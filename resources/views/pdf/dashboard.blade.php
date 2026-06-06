<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Dashboard - {{ date('d/m/Y') }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #131b2e;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #131b2e;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .summary-box {
            width: 100%;
            margin-bottom: 30px;
        }
        .summary-box td {
            padding: 15px;
            border: 1px solid #ddd;
        }
        .summary-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 5px;
            display: block;
        }
        .summary-value {
            font-size: 18px;
            font-weight: bold;
            color: #131b2e;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #131b2e;
            border-left: 4px solid #131b2e;
            padding-left: 10px;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
            font-size: 10px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>K20 LAUNDRY</h1>
        <p>Cabang: {{ $namaCabang }}</p>
        <p>Laporan Ringkasan Dashboard - {{ date('d F Y') }}</p>
    </div>

    <div class="section-title">Ringkasan Finansial Hari Ini</div>
    <table class="summary-box">
        <tr>
            <td width="33%">
                <span class="summary-label">Total Pemasukan</span>
                <span class="summary-value">Rp {{ number_format($pemasukanHariIni, 0, ',', '.') }}</span>
            </td>
            <td width="33%">
                <span class="summary-label">Total Pengeluaran</span>
                <span class="summary-value">Rp {{ number_format($pengeluaranHariIni, 0, ',', '.') }}</span>
            </td>
            <td width="33%">
                <span class="summary-label">Saldo</span>
                <span class="summary-value">Rp {{ number_format($saldoHariIni, 0, ',', '.') }}</span>
            </td>
        </tr>
    </table>

    <div class="section-title">Statistik Operasional</div>
    <table class="summary-box">
        <tr>
            <td width="33%">
                <span class="summary-label">Jumlah Transaksi</span>
                <span class="summary-value">{{ $jumlahTransaksiHariIni }} Order</span>
            </td>
            <td width="33%">
                <span class="summary-label">Transaksi Proses</span>
                <span class="summary-value">{{ $transaksiProses }} Order</span>
            </td>
            <td width="33%">
                <span class="summary-label">Transaksi Selesai</span>
                <span class="summary-value">{{ $transaksiSelesai }} Order</span>
            </td>
        </tr>
    </table>

    <div class="footer">
        Dicetak pada: {{ date('d/m/Y H:i:s') }}
    </div>
</body>
</html>
