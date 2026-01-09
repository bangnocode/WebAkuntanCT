@extends('layouts.app')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <div class="flex flex-col gap-1 md:flex-row md:justify-between md:items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Laporan Laba Rugi</h2>
            <p class="text-gray-600 text-sm">Pendapatan vs Biaya</p>
        </div>
        <div class="text-sm text-gray-500">
            Per Tanggal: {{ date('d M Y') }}
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- PENDAPATAN -->
        <div class="p-6 border-b border-gray-100">
            <h3 class="font-bold text-blue-800 text-lg mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                PENDAPATAN
            </h3>
            <div class="space-y-3">
                @forelse($pendapatan as $rek)
                <div class="flex justify-between items-center text-sm group hover:bg-gray-50 p-2 rounded transition">
                    <div class="flex items-center">
                        <span class="font-mono text-gray-500 w-20 text-xs">{{ $rek->KODER }}</span>
                        <span class="text-gray-800 font-medium">{{ $rek->NAMA }}</span>
                    </div>
                    <span class="font-mono text-gray-700">{{ number_format($rek->SALDO, 0, ',', '.') }}</span>
                </div>
                @empty
                <div class="text-center text-gray-400 py-4 text-sm">Tidak ada data Pendapatan</div>
                @endforelse
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                <span class="font-bold text-gray-600">Total Pendapatan</span>
                <span class="font-bold text-lg text-blue-700 font-mono">{{ number_format($totalPendapatan, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- BIAYA -->
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <h3 class="font-bold text-red-800 text-lg mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                </svg>
                BIAYA
            </h3>
            <div class="space-y-3">
                @forelse($biaya as $rek)
                <div class="flex justify-between items-center text-sm group hover:bg-gray-50 p-2 rounded transition">
                    <div class="flex items-center">
                        <span class="font-mono text-gray-500 w-20 text-xs">{{ $rek->KODER }}</span>
                        <span class="text-gray-800 font-medium">{{ $rek->NAMA }}</span>
                    </div>
                    <span class="font-mono text-gray-700">{{ number_format($rek->SALDO, 0, ',', '.') }}</span>
                </div>
                @empty
                <div class="text-center text-gray-400 py-4 text-sm">Tidak ada data Biaya</div>
                @endforelse
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                <span class="font-bold text-gray-600">Total Biaya</span>
                <span class="font-bold text-lg text-red-700 font-mono">{{ number_format($totalBiaya, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- RESULT -->
        <div class="p-6 {{ $labaBersih >= 0 ? 'bg-green-50' : 'bg-red-50' }}">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-xl {{ $labaBersih >= 0 ? 'text-green-800' : 'text-red-800' }}">
                        {{ $labaBersih >= 0 ? 'LABA BERSIH' : 'RUGI BERSIH' }}
                    </h3>
                    <p class="text-xs {{ $labaBersih >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        (Total Pendapatan - Total Biaya)
                    </p>
                </div>
                <div class="text-right">
                    <span class="block font-bold text-2xl {{ $labaBersih >= 0 ? 'text-green-700' : 'text-red-700' }} font-mono">
                        Rp {{ number_format(abs($labaBersih), 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection