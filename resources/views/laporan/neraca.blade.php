@extends('layouts.app')

@section('content')
<style>
    .document-container {
        font-family: 'Times New Roman', Times, serif;
        background-color: white;
        max-width: 210mm;
        margin: 0 auto;
        padding: 20mm;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        color: #000;
    }
    .doc-header {
        text-align: center;
        margin-bottom: 2rem;
        border-bottom: 2px solid #000;
        padding-bottom: 1rem;
    }
    .doc-title {
        font-size: 24px;
        text-transform: uppercase;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .doc-subtitle {
        font-size: 16px;
    }
    .doc-section-title {
        font-size: 18px;
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 10px;
        text-decoration: underline;
        text-transform: uppercase;
    }
    .doc-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
        margin-bottom: 20px;
    }
    .doc-table th, .doc-table td {
        border: 1px solid #000;
        padding: 4px 8px;
    }
    .doc-table th {
        background-color: #f0f0f0;
        text-align: center;
        font-weight: bold;
    }
    .text-right { text-align: right; }
    .text-center { text-align: center; }
    .font-bold { font-weight: bold; }
    
    /* Indentation */
    .level-1 td:nth-child(2) { font-weight: bold; background-color: #f9f9f9; }
    .level-2 td:nth-child(2) { font-weight: bold; padding-left: 20px; }
    .level-3 td:nth-child(2) { padding-left: 40px; }

    .total-row {
        font-weight: bold;
        background-color: #e0e0e0;
    }
</style>

<div class="flex justify-end mb-4 max-w-5xl mx-auto print:hidden">
    <a href="{{ route('laporan.pdf') }}" target="_blank" class="bg-gray-800 text-white px-4 py-2 rounded shadow hover:bg-gray-700 flex items-center gap-2 text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
        Open Print View
    </a>
</div>

<div class="document-container">
    <div class="doc-header">
        <div class="doc-title">Laporan Neraca</div>
        <div class="doc-subtitle">Per Tanggal: {{ date('d F Y') }}</div>
    </div>

    <!-- AKTIVA -->
    <div class="doc-section-title">AKTIVA</div>
    <table class="doc-table">
        <thead>
            <tr>
                <th width="15%">Kode Akun</th>
                <th>Nama Akun</th>
                <th width="20%">Saldo (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($aktiva as $rek)
            <tr class="{{ $rek->class ?? '' }}">
                <td class="text-center">{{ $rek->KODER }}</td>
                <td>{{ $rek->NAMA }}</td>
                <td class="text-right">{{ number_format($rek->SALDO, 2, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center py-4">Tidak ada data Aktiva</td>
            </tr>
            @endforelse
            <tr class="total-row">
                <td colspan="2" class="text-center">TOTAL AKTIVA</td>
                <td class="text-right">{{ number_format($totalAktiva, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <br>

    <!-- PASIVA -->
    <div class="doc-section-title">PASIVA</div>
    <table class="doc-table">
        <thead>
            <tr>
                <th width="15%">Kode Akun</th>
                <th>Nama Akun</th>
                <th width="20%">Saldo (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pasiva as $rek)
            <tr class="{{ $rek->class ?? '' }}">
                <td class="text-center">{{ $rek->KODER }}</td>
                <td>{{ $rek->NAMA }}</td>
                <td class="text-right">{{ number_format($rek->SALDO, 2, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center py-4">Tidak ada data Pasiva</td>
            </tr>
            @endforelse
            <tr class="total-row">
                <td colspan="2" class="text-center">TOTAL PASIVA</td>
                <td class="text-right">{{ number_format($totalPasiva, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- BALANCE CHECK -->
    <div style="margin-top: 30px; border-top: 1px dashed #999; padding-top: 10px; text-align: center;">
        @if($totalAktiva == $totalPasiva)
            <div style="font-weight: bold; color: green; font-size: 14px;">[ NERACA SEIMBANG (BALANCED) ]</div>
        @else
            <div style="font-weight: bold; color: red; font-size: 14px;">[ NERACA TIDAK SEIMBANG / UNBALANCED ]</div>
            <div style="color: red; font-size: 12px;">Selisih: Rp {{ number_format(abs($totalAktiva - $totalPasiva), 2, ',', '.') }}</div>
        @endif
    </div>
</div>
@endsection