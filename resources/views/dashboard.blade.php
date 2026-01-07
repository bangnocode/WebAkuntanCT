@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Ringkasan Keuangan</h2>
            <p class="text-gray-600">Selamat datang kembali,
                {{ Auth::user()->name }}
                !</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-8">
            <!-- Total Accounts Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-50 rounded-lg">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Jumlah Rekening</p>
                        <h3 class="text-xl font-bold text-gray-800">{{ $totalAccounts }}</h3>
                    </div>
                </div>
            </div>

            <!-- Cash Balance Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-green-50 rounded-lg">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Saldo Kas</p>
                        <h3 class="text-xl font-bold text-gray-800">Rp
                            {{ number_format($totalCashBalance, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity / Placeholder -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Aktivitas Terbaru</h3>
            <div class="flex flex-col items-center justify-center py-12 text-center">
                <div class="bg-gray-50 p-4 rounded-full mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <p class="text-gray-500 font-medium">Belum ada aktivitas tercatat</p>
                <p class="text-gray-400 text-sm mt-1">Mulai pencatatan transaksi untuk melihat aktivitas di sini.</p>
            </div>
        </div>
    </main>

    <!-- Alpine.js for interactive components -->
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
