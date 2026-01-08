@extends('layouts.app')

@section('content')
<div class="space-y-4 sm:space-y-6">
    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <h2 class="text-base font-bold text-gray-800 mb-4">Laporan Buku Besar</h2>

        <form action="{{ route('laporan.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ $startDate }}"
                    class="w-full text-xs px-2.5 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500 bg-white">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ $endDate }}"
                    class="w-full text-xs px-2.5 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500 bg-white">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Akun / Rekening</label>
                <select name="koder" class="select2-rekening w-full" style="width: 100%">
                    <option value="">-- Semua Rekening --</option>
                    @foreach($rekeningList as $rek)
                    <option value="{{ $rek->KODER }}" {{ $koder == $rek->KODER ? 'selected' : '' }}>
                        {{ $rek->KODER }} - {{ $rek->NAMA }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-4 flex justify-end gap-2">
                <a href="{{ route('laporan.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                    Reset
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors shadow-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Tampilkan
                    </div>
                </button>
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Slip</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Akun</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo Awal</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Debit</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Kredit</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo Akhir</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($laporan as $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($row->TGL)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-mono text-gray-600">
                            {{ $row->NOSLIP }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm">
                            <div class="font-medium text-gray-900">{{ $row->KODER }}</div>
                            <div class="text-xs text-gray-500 truncate max-w-[200px]">{{ $row->NAMA_REKENING }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600">
                            {{ $row->KET }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-right font-mono text-gray-600 font-medium">
                            {{ number_format($row->SALDOAWAL, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-right font-mono text-green-600 font-medium">
                            {{ number_format($row->DEBIT, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-right font-mono text-red-600 font-medium">
                            {{ number_format($row->KREDIT, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-right font-mono text-blue-600 font-medium">
                            {{ number_format($row->SALDO, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center p-4">
                                <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p>Tidak ada data ditemukan untuk filter ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-gray-50 font-bold">
                    <tr>
                        <td colspan="5" class="px-4 py-3 text-right text-sm text-gray-700">Total Periode Ini:</td>
                        <td class="px-4 py-3 text-right text-sm text-green-700 font-mono">
                            {{ number_format($laporan->sum('DEBIT'), 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-right text-sm text-red-700 font-mono">
                            {{ number_format($laporan->sum('KREDIT'), 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select2-rekening').select2({
            theme: 'bootstrap-5',
            placeholder: 'Pilih Rekening',
            allowClear: true,
            selectionCssClass: 'select2--small',
            dropdownCssClass: 'select2--small'
        });
    });
</script>
@endsection