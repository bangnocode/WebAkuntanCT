@extends('layouts.app')

@section('content')
<div x-data="jurnalApp()" class="flex flex-col bg-gray-50">
    <!-- HEADER & CART TABLE -->
    <div class="flex-grow overflow-auto space-y-2 sm:space-y-3">
        <!-- Header Summary -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-2.5 sm:p-3">
            <div class="flex items-center justify-between gap-2">
                <h2 class="text-sm sm:text-base font-bold text-gray-800">Jurnal Akuntansi</h2>

                <div class="flex gap-1.5 text-[11px] font-semibold">
                    <div class="bg-green-50 px-2.5 py-1.5 rounded border border-green-200 text-green-700">
                        <span class="hidden sm:inline">D: </span><span x-text="formatRupiah(totalDebit)"></span>
                    </div>
                    <div class="bg-red-50 px-2.5 py-1.5 rounded border border-red-200 text-red-700">
                        <span class="hidden sm:inline">K: </span><span x-text="formatRupiah(totalKredit)"></span>
                    </div>
                    <div class="px-2.5 py-1.5 rounded border font-bold"
                        :class="isBalanced ? 'bg-blue-50 text-blue-700 border-blue-200' :
                                'bg-amber-50 text-amber-700 border-amber-200'">
                        <span x-text="isBalanced ? '✓' : '⚠'"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr class="text-[11px] text-gray-600 font-semibold uppercase">
                            <th class="px-2.5 py-2.5 text-left w-24">Tgl</th>
                            <th class="px-2.5 py-2.5 text-left w-20">Kode</th>
                            <th class="px-2.5 py-2.5 text-left">Akun</th>
                            <th class="px-2.5 py-2.5 text-left hidden md:table-cell">Keterangan</th>
                            <th class="px-2.5 py-2.5 text-right w-28">Debit</th>
                            <th class="px-2.5 py-2.5 text-right w-28">Kredit</th>
                            <th class="px-2.5 py-2.5 w-10"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <template x-for="(item, index) in cart" :key="index">
                            <tr class="hover:bg-gray-50 text-xs">
                                <td class="px-2.5 py-2.5 text-gray-600 text-[11px]" x-text="formatDate(item.tgl)"></td>
                                <td class="px-2.5 py-2.5">
                                    <span class="font-mono text-[11px] text-blue-700 font-semibold"
                                        x-text="item.koder"></span>
                                </td>
                                <td class="px-2.5 py-2.5">
                                    <div class="font-medium text-gray-800 truncate max-w-[140px] sm:max-w-none"
                                        x-text="item.nama_rekening"></div>
                                    <div class="md:hidden text-[10px] text-gray-500 truncate max-w-[140px]"
                                        x-text="item.ket"></div>
                                </td>
                                <td class="px-2.5 py-2.5 text-gray-600 truncate max-w-xs hidden md:table-cell"
                                    x-text="item.ket"></td>
                                <td class="px-2.5 py-2.5 text-right font-mono text-green-600 font-semibold text-xs"
                                    x-text="item.dk === 'D' ? formatRupiah(item.nominal) : '-'"></td>
                                <td class="px-2.5 py-2.5 text-right font-mono text-red-600 font-semibold text-xs"
                                    x-text="item.dk === 'K' ? formatRupiah(item.nominal) : '-'"></td>
                                <td class="px-2.5 py-2.5 text-center">
                                    <button @click="removeItem(index)" class="text-red-500 hover:bg-red-50 rounded p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="cart.length === 0">
                            <td colspan="7" class="text-center py-8 text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-2 opacity-30" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <p class="text-xs font-medium">Belum ada data</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- FORM INPUT - FIXED AT BOTTOM -->
    <div class="fixed bottom-0 left-0 md:left-64 right-0 bg-white border-t shadow-lg z-10">
        <div class="p-4 space-y-2 max-w-screen-2xl mx-auto">
            <h4 class="text-[11px] font-bold text-gray-600 uppercase">Input Baru</h4>

            <!-- Baris 1: Tanggal, Kode (Mobile: Tanggal saja) -->
            <div class="grid grid-cols-1 sm:grid-cols-8 gap-2">
                <div>
                    <label class="text-xs text-gray-500 font-semibold block mb-1">Tanggal</label>
                    <input type="date" x-model="lineItem.tgl"
                        class="w-full text-xs px-2.5 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500 bg-white">
                </div>

                <div class="relative hidden sm:block">
                    <label class="text-xs text-gray-500 font-semibold block mb-1">Kode</label>
                    <input type="text" x-model="lineItem.koder" @input.debounce.500ms="searchRekening"
                        @keydown.enter.prevent="searchRekening" placeholder="1101" autofocus
                        :class="rekeningStatus === 'not_found' ?
                                'border-red-400 focus:border-red-500 focus:ring-2 focus:ring-red-200' :
                                (rekeningStatus === 'found' ?
                                    'border-green-400 focus:border-green-500 focus:ring-2 focus:ring-green-200' :
                                    'border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200')"
                        class="w-full text-xs px-2.5 py-2 rounded border focus:outline-none focus:ring-2 focus:ring-blue-200 
                  transition-all duration-200 ease-in-out bg-white font-mono shadow-sm">
                    <div x-show="isSearching" class="absolute right-2 top-8">
                        <svg class="animate-spin h-3 w-3 text-blue-500" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                </div>

                <div class="sm:col-span-4 hidden sm:block">
                    <label class="text-xs text-gray-500 font-semibold block mb-1">Nama Akun</label>
                    <input type="text" readonly :value="lineItem.nama_rekening" placeholder="Otomatis terisi..."
                        class="w-full text-xs px-2.5 py-2 rounded border border-gray-200 bg-gray-50 text-gray-700">
                    <p x-show="rekeningStatus === 'not_found'" class="text-[10px] text-red-600 mt-0.5">Tidak ditemukan
                    </p>
                </div>

                <div class="sm:col-span-2 hidden sm:block">
                    <label class="text-xs text-gray-500 font-semibold block mb-1">Nominal (Rp)</label>
                    <input x-ref="amountInput" type="text" x-model="nominalFormatted"
                        @input="handleNominalInput($event.target.value)" @blur="handleNominalBlur"
                        @focus="handleNominalFocus" @keydown.enter.prevent="tryAddToCart" placeholder="0"
                        class="w-full text-xs px-2.5 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500 bg-white text-right font-mono">
                </div>
            </div>

            <!-- Mobile: Baris 2 - Kode & Nama Akun -->
            <div class="grid grid-cols-2 gap-2 sm:hidden">
                <div class="relative">
                    <label class="text-[10px] text-gray-500 font-semibold block mb-1">Kode</label>
                    <input type="text" x-model="lineItem.koder" @input.debounce.500ms="searchRekening" autofocus
                        @keydown.enter.prevent="searchRekening" placeholder="1101" autofocus
                        :class="rekeningStatus === 'not_found' ?
                                'border-red-400 focus:border-red-500 focus:ring-2 focus:ring-red-200' :
                                (rekeningStatus === 'found' ?
                                    'border-green-400 focus:border-green-500 focus:ring-2 focus:ring-green-200' :
                                    'border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200')"
                        class="w-full text-xs px-2.5 py-2 rounded border focus:outline-none focus:ring-2 focus:ring-blue-200 
                  transition-all duration-200 ease-in-out bg-white font-mono shadow-sm">
                    <div x-show="isSearching" class="absolute right-2 top-8">
                        <svg class="animate-spin h-3 w-3 text-blue-500" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                </div>

                <div>
                    <label class="text-[10px] text-gray-500 font-semibold block mb-1">Nama Akun</label>
                    <input type="text" readonly :value="lineItem.nama_rekening" placeholder="Otomatis..."
                        class="w-full text-xs px-2.5 py-2 rounded border border-gray-200 bg-gray-50 text-gray-700">
                    <p x-show="rekeningStatus === 'not_found'" class="text-[10px] text-red-600 mt-0.5">Tidak ditemukan
                    </p>
                </div>
            </div>

            <!-- Mobile: Baris 3 - Nominal & Keterangan -->
            <div class="grid grid-cols-2 gap-2 sm:hidden">
                <div>
                    <label class="text-[10px] text-gray-500 font-semibold block mb-1">Nominal (Rp)</label>
                    <input x-ref="amountInputMobile" type="text" x-model="nominalFormatted"
                        @input="handleNominalInput($event.target.value)" @blur="handleNominalBlur"
                        @focus="handleNominalFocus" @keydown.enter.prevent="tryAddToCart" placeholder="0"
                        class="w-full text-xs px-2.5 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500 bg-white text-right font-mono">
                </div>

                <div>
                    <label class="text-[10px] text-gray-500 font-semibold block mb-1">Keterangan</label>
                    <input type="text" x-model="lineItem.ket" placeholder="Keterangan..."
                        class="w-full text-xs px-2.5 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500 bg-white">
                </div>
            </div>

            <!-- Mobile: Baris 4 - D/K -->
            <div class="sm:hidden">
                <label class="text-[10px] text-gray-500 font-semibold block mb-1">D/K</label>
                <select x-model="lineItem.dk"
                    class="w-full text-xs px-2.5 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500 bg-white font-bold"
                    :class="lineItem.dk === 'D' ? 'text-green-600' : 'text-red-600'">
                    <option value="D" class="text-green-600">Debit</option>
                    <option value="K" class="text-red-600">Kredit</option>
                </select>
            </div>

            <!-- Baris 2 Desktop: Keterangan, D/K, Button Tambah, Button Simpan -->
            <div class="hidden sm:grid sm:grid-cols-8 gap-2">
                <div class="sm:col-span-4">
                    <label class="text-xs text-gray-500 font-semibold block mb-1">Keterangan</label>
                    <input type="text" x-model="lineItem.ket" placeholder="Keterangan transaksi..."
                        @keydown.enter.prevent="$refs.amountInput.focus()"
                        class="w-full text-xs px-2.5 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500 bg-white">
                </div>

                <div>
                    <label class="text-xs text-gray-500 font-semibold block mb-1">D/K</label>
                    <select x-model="lineItem.dk"
                        class="w-full text-xs px-2.5 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500 bg-white font-bold"
                        :class="lineItem.dk === 'D' ? 'text-green-600' : 'text-red-600'">
                        <option value="D" class="text-green-600">Debit</option>
                        <option value="K" class="text-red-600">Kredit</option>
                    </select>
                </div>

                <div class="sm:col-span-3 flex gap-2">
                    <button type="button" @click="tryAddToCart" :disabled="!isValidLine"
                        class="flex-1 bg-gray-700 text-white px-4 py-2 rounded text-xs font-semibold hover:bg-gray-800 
               disabled:bg-gray-300 disabled:cursor-not-allowed transition-all duration-200 
               active:scale-95 transform">
                        + Tambah
                    </button>

                    <button type="button" @click="$refs.submitForm.submit()" :disabled="!canSubmit"
                        class="flex-1 bg-blue-600 text-white flex justify-center items-center gap-1 px-4 py-2 rounded text-xs font-semibold hover:bg-blue-700 disabled:bg-blue-200 disabled:cursor-not-allowed transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                            class="bi bi-floppy-fill" viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z" />
                            <path
                                d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z" />
                        </svg> Simpan
                    </button>
                </div>
            </div>

            <!-- Mobile: Buttons -->
            <div class="grid grid-cols-2 gap-2 sm:hidden">
                <button type="button" @click="tryAddToCart" :disabled="!isValidLine"
                    class="bg-gray-700 text-white px-4 py-2 rounded text-xs font-semibold hover:bg-gray-800 
               disabled:bg-gray-300 disabled:cursor-not-allowed transition-all duration-200 
               active:scale-95 transform">
                    + Tambah
                </button>

                <button type="button" @click="$refs.submitFormMobile.submit()" :disabled="!canSubmit"
                    class="bg-blue-600 text-white px-4 flex justify-center items-center gap-1 py-2 rounded text-xs font-semibold hover:bg-blue-700 disabled:bg-blue-200 disabled:cursor-not-allowed transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                        class="bi bi-floppy-fill" viewBox="0 0 16 16">
                        <path
                            d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z" />
                        <path
                            d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z" />
                    </svg> Simpan
                </button>
            </div>

            <!-- Hidden Forms -->
            <form x-ref="submitForm" action="{{ route('jurnal.store') }}" method="POST" class="hidden">
                @csrf
                <template x-for="(item, index) in cart" :key="index">
                    <div>
                        <input type="hidden" :name="'cart[' + index + '][tgl]'" :value="item.tgl">
                        <input type="hidden" :name="'cart[' + index + '][koder]'" :value="item.koder">
                        <input type="hidden" :name="'cart[' + index + '][dk]'" :value="item.dk">
                        <input type="hidden" :name="'cart[' + index + '][nominal]'" :value="item.nominal">
                        <input type="hidden" :name="'cart[' + index + '][ket]'" :value="item.ket">
                    </div>
                </template>
            </form>

            <form x-ref="submitFormMobile" action="{{ route('jurnal.store') }}" method="POST" class="hidden">
                @csrf
                <template x-for="(item, index) in cart" :key="index">
                    <div>
                        <input type="hidden" :name="'cart[' + index + '][tgl]'" :value="item.tgl">
                        <input type="hidden" :name="'cart[' + index + '][koder]'" :value="item.koder">
                        <input type="hidden" :name="'cart[' + index + '][dk]'" :value="item.dk">
                        <input type="hidden" :name="'cart[' + index + '][nominal]'" :value="item.nominal">
                        <input type="hidden" :name="'cart[' + index + '][ket]'" :value="item.ket">
                    </div>
                </template>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('jurnalApp', () => ({
            isSearching: false,
            lineItem: {
                tgl: new Date().toISOString().split('T')[0],
                koder: '',
                nama_rekening: '',
                ket: '',
                nominal: '', // Simpan nilai asli di sini
                dk: 'D'
            },
            nominalFormatted: '', // Untuk tampilan dengan format
            rekeningStatus: 'idle',
            cart: [],

            init() {
                // Initialize dengan tanggal hari ini
                this.lineItem.tgl = new Date().toISOString().split('T')[0];
            },

            // Fungsi untuk memformat angka ke Rupiah
            formatRupiahInput(value) {
                // Hapus semua karakter non-digit
                const number = value.replace(/\D/g, '');

                // Format dengan titik pemisah ribuan
                return number.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            },

            // Fungsi untuk mengubah format ke angka biasa
            parseRupiahInput(value) {
                // Hapus semua titik
                return value.replace(/\./g, '');
            },

            // Handler untuk input nominal
            handleNominalInput(value) {
                // Simpan format tampilan
                this.nominalFormatted = this.formatRupiahInput(value);

                // Simpan nilai asli (tanpa format) di lineItem.nominal
                const rawValue = this.parseRupiahInput(value);
                this.lineItem.nominal = rawValue === '' ? '' : parseInt(rawValue) || 0;
            },

            // Handler untuk saat input kehilangan fokus
            handleNominalBlur() {
                if (this.lineItem.nominal) {
                    // Format ulang saat blur untuk memastikan format konsisten
                    this.nominalFormatted = this.formatRupiahInput(this.lineItem.nominal
                        .toString());
                }
            },

            // Handler untuk saat input mendapatkan fokus
            handleNominalFocus() {
                // Kosongkan format saat fokus untuk memudahkan editing
                this.nominalFormatted = this.lineItem.nominal ? this.lineItem.nominal.toString() :
                    '';
            },

            async searchRekening() {
                if (this.lineItem.koder.length < 3) return;

                this.isSearching = true;
                this.rekeningStatus = 'idle';
                this.lineItem.nama_rekening = 'Mencari...';

                try {
                    const response = await fetch(
                        `{{ route('jurnal.search') }}?koder=${this.lineItem.koder}`);
                    const data = await response.json();

                    if (data.status === 'found') {
                        this.rekeningStatus = 'found';
                        this.lineItem.nama_rekening = data.nama;
                    } else {
                        this.rekeningStatus = 'not_found';
                        this.lineItem.nama_rekening = '';
                    }
                } catch (e) {
                    console.error(e);
                    this.rekeningStatus = 'not_found';
                    this.lineItem.nama_rekening = 'Error koneksi';
                } finally {
                    this.isSearching = false;
                }
            },

            get isValidLine() {
                return this.rekeningStatus === 'found' &&
                    this.lineItem.nominal > 0 &&
                    this.lineItem.ket.length > 0 &&
                    this.lineItem.tgl;
            },

            tryAddToCart() {
                if (this.isValidLine) {
                    this.cart.push({
                        ...this.lineItem
                    });

                    const lastDate = this.lineItem.tgl;
                    const lastDK = this.lineItem.dk;

                    // Reset form
                    this.lineItem.koder = '';
                    this.lineItem.nama_rekening = '';
                    this.lineItem.ket = '';
                    this.lineItem.nominal = '';
                    this.nominalFormatted = ''; // Reset format juga
                    this.lineItem.tgl = lastDate;
                    this.lineItem.dk = lastDK === 'D' ? 'K' : 'D';

                    this.rekeningStatus = 'idle';

                    // Setelah menambahkan cart, fokuskan ke input kode
                    setTimeout(() => {
                        // Cari input kode yang visible (mobile atau desktop)
                        const codeInputDesktop = document.querySelector(
                            'input[x-model="lineItem.koder"]:not(.hidden)');
                        const codeInputMobile = document.querySelector(
                            'input[x-model="lineItem.koder"][autofocus]');

                        const targetInput = codeInputDesktop || codeInputMobile;
                        if (targetInput) {
                            targetInput.focus();
                            // Tambahkan animasi fokus untuk emphasis
                            targetInput.classList.add('ring-4', 'ring-blue-200',
                                'ring-offset-0');

                            // Hapus ring setelah 1 detik untuk efek visual
                            setTimeout(() => {
                                targetInput.classList.remove('ring-4',
                                    'ring-blue-200', 'ring-offset-0');
                            }, 1000);
                        }
                    }, 100);
                }
            },

            removeItem(index) {
                this.cart.splice(index, 1);
            },

            get totalDebit() {
                return this.cart.filter(i => i.dk === 'D').reduce((acc, curr) => acc + Number(
                    curr.nominal), 0);
            },
            get totalKredit() {
                return this.cart.filter(i => i.dk === 'K').reduce((acc, curr) => acc + Number(
                    curr.nominal), 0);
            },
            get isBalanced() {
                return this.totalDebit === this.totalKredit && this.cart.length > 0;
            },
            get canSubmit() {
                return this.isBalanced;
            },

            // Fungsi untuk format tampilan di tabel
            formatRupiah(value) {
                return new Intl.NumberFormat('id-ID').format(value);
            },

            formatDate(dateString) {
                const options = {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                };
                return new Date(dateString).toLocaleDateString('id-ID', options);
            }
        }));
    });
</script>
@endsection