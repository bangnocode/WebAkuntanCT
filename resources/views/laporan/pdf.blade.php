@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #525659;
            margin: 0;
            padding: 20px;
        }
        .page {
            background-color: white;
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 20mm;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            position: relative;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .header h3 {
            margin: 5px 0 0;
            font-size: 16px;
            font-weight: normal;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            padding: 4px 8px;
            border: 1px solid #000;
        }
        th {
            background-color: #f0f0f0;
            text-align: center;
            font-weight: bold;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        
        /* Indentation for Hierarchy */
        .level-1 td:nth-child(2) { font-weight: 900; background-color: #f9f9f9; }
        .level-2 td:nth-child(2) { font-weight: 700; padding-left: 20px; }
        .level-3 td:nth-child(2) { padding-left: 40px; }

        .total-row {
            font-weight: bold;
            background-color: #e0e0e0;
        }

        @media print {
            body {
                background-color: white;
                margin: 0;
                padding: 0;
            }
            .page {
                box-shadow: none;
                margin: 0;
                width: auto;
                min-height: auto;
            }
            .no-print {
                display: none;
            }
        }

        .floating-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            padding: 15px 20px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            font-family: Arial, sans-serif;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: transform 0.2s;
        }
        .floating-btn:hover {
            transform: scale(1.05);
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <a href="javascript:window.print()" class="floating-btn no-print">
        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
            <path fill="currentColor" d="M19,8H5C3.34,8 2,9.34 2,11V17H6V21H18V17H22V11C22,9.34 20.66,8 19,8M16,19H8V14H16V19M19,12C18.45,12 18,11.55 18,11C18,10.45 18.45,10 19,10C19.55,10 20,10.45 20,11C20,11.55 19.55,12 19,12M6,1.5H18V6H6V1.5Z" />
        </svg>
        Cetak / Print PDF
    </a>

    <div class="page">
        <div class="header">
            <h2>Laporan Keuangan {{ $type === 'neraca' ? 'NERACA' : ($type === 'labarugi' ? 'LABA RUGI' : '') }}</h2>
            <h3>Per Tanggal: {{ Carbon::now()->translatedFormat('d F Y') }}</h3>
        </div>

        <!-- NERACA -->
        @if($neraca->isNotEmpty())
        <div class="section-title">NERACA</div>
        <table>
            <thead>
                <tr>
                    <th width="15%">Kode Akun</th>
                    <th>Nama Akun</th>
                    <th width="20%">Saldo (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($neraca as $akun)
                    <tr class="{{ $akun['class'] ?? '' }}">
                        <td class="text-center">{{ $akun['KODER'] }}</td>
                        <td>{{ $akun['NAMA'] }}</td>
                        <td class="text-right">{{ number_format($akun['SALDO'], 2, ',', '.') }}</td>
                    </tr>
                @endforeach

                <tr class="total-row">
                    <td colspan="2" class="text-center">TOTAL AKTIVA</td>
                    <td class="text-right">{{ number_format($totalAktiva, 2, ',', '.') }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="2" class="text-center">TOTAL PASIVA</td>
                    <td class="text-right">{{ number_format($totalPasiva, 2, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
        @endif

        @if($neraca->isNotEmpty() && $labarugi->isNotEmpty())
        <br><br>
        @endif

        <!-- LABA RUGI -->
        @if($labarugi->isNotEmpty())
        <div class="section-title">LABA RUGI</div>
        <table>
            <thead>
                <tr>
                    <th width="15%">Kode Akun</th>
                    <th>Nama Akun</th>
                    <th width="20%">Saldo (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($labarugi as $akun)
                    <tr class="{{ $akun['class'] ?? '' }}">
                        <td class="text-center">{{ $akun['KODER'] }}</td>
                        <td>{{ $akun['NAMA'] }}</td>
                        <td class="text-right">{{ number_format($akun['SALDO'], 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="2" class="text-center">LABA / RUGI BERSIH</td>
                    <td class="text-right">{{ number_format($labaBersih, 2, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
        @endif
    </div>
</body>
</html>
