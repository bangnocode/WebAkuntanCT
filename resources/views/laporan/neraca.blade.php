@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-1 md:flex-row md:justify-between md:items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Laporan Neraca</h2>
            <p class="text-gray-600 text-sm">Posisi Keuangan (Aktiva vs Pasiva)</p>
        </div>
        <div class="text-sm text-gray-500">
            Per Tanggal: {{ date('d M Y') }}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
        <!-- AKTIVA (ASSETS) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-full">
            <div class="bg-green-50 px-6 py-4 border-b border-green-100">
                <h3 class="font-bold text-green-800 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    AKTIVA
                </h3>
            </div>
            <div class="p-0 flex-grow">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 font-medium border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-2 text-left">Kode</th>
                            <th class="px-6 py-2 text-left">Nama Akun</th>
                            <th class="px-6 py-2 text-right">Saldo</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($aktiva as $rek)
                        <tr class="hover:bg-gray-50/50">
                            <td class="px-6 py-2 font-mono text-gray-600 text-xs">{{ $rek->KODER }}</td>
                            <td class="px-6 py-2 text-gray-800">{{ $rek->NAMA }}</td>
                            <td class="px-6 py-2 text-right font-mono text-gray-800">
                                {{ number_format($rek->SALDO, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-400 text-xs">
                                Tidak ada data Aktiva
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 mt-auto">
                <div class="flex justify-between items-center">
                    <span class="font-bold text-gray-700 text-md">TOTAL AKTIVA</span>
                    <span class="font-bold text-xl text-green-700 font-mono">
                        {{ number_format($totalAktiva, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- PASIVA (LIABILITIES + EQUITY) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-full">
            <div class="bg-orange-50 px-6 py-4 border-b border-orange-100">
                <h3 class="font-bold text-orange-800 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    PASIVA
                </h3>
            </div>
            <div class="p-0 flex-grow">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 font-medium border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-2 text-left">Kode</th>
                            <th class="px-6 py-2 text-left">Nama Akun</th>
                            <th class="px-6 py-2 text-right">Saldo</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($pasiva as $rek)
                        <tr class="hover:bg-gray-50/50">
                            <td class="px-6 py-2 font-mono text-gray-600 text-xs">{{ $rek->KODER }}</td>
                            <td class="px-6 py-2 text-gray-800">{{ $rek->NAMA }}</td>
                            <td class="px-6 py-2 text-right font-mono text-gray-800">
                                {{ number_format($rek->SALDO, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-400 text-xs">
                                Tidak ada data Pasiva
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 mt-auto">
                <div class="flex justify-between items-center">
                    <span class="font-bold text-gray-700 text-md">TOTAL PASIVA</span>
                    <span class="font-bold text-xl text-orange-700 font-mono">
                        {{ number_format($totalPasiva, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Balance Check -->
    <div class="rounded-lg p-4 {{ $totalAktiva == $totalPasiva ? 'bg-blue-50 border border-blue-200' : 'bg-red-50 border border-red-200' }} flex justify-between items-center">
        <div>
            <h4 class="font-bold {{ $totalAktiva == $totalPasiva ? 'text-blue-800' : 'text-red-800' }} ">
                {{ $totalAktiva == $totalPasiva ? 'Neraca Seimbang (Balanced)' : 'Neraca Tidak Seimbang (Unbalanced)' }}
            </h4>
            <p class="text-xs {{ $totalAktiva == $totalPasiva ? 'text-blue-600' : 'text-red-600' }}">
                {{ $totalAktiva == $totalPasiva ? 'Total Aktiva sama dengan Total Pasiva.' : 'Terdapat selisih antara Aktiva dan Pasiva. Selisih: Rp ' . number_format(abs($totalAktiva - $totalPasiva), 0, ',', '.') }}
            </p>
        </div>
        @if($totalAktiva == $totalPasiva)
        <div class="bg-blue-200 p-2 rounded-full">
            <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        @else
        <div class="bg-red-200 p-2 rounded-full">
            <svg class="w-6 h-6 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        @endif
    </div>
</div>
@endsection