@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Master Rekening</h2>
            <p class="text-gray-600 text-sm">Kelola data rekening akuntansi</p>
        </div>
    </div>

    <!-- Form Tambah Rekening (Card) -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-semibold text-lg text-gray-800 mb-4">Tambah Rekening Baru</h3>
        <form action="{{ route('rekening.store') }}" method="POST"
            class="grid grid-cols-1 lg:grid-cols-4 gap-4 items-end">
            @csrf

            <!-- Kode Rekening -->
            <div class="lg:col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Kode Rekening (KODER)</label>
                <input type="text" name="KODER" required
                    class="w-full text-xs rounded-sm border border-gray-300 bg-white py-2 px-3 text-gray-700 placeholder-gray-400
              focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 
              hover:border-blue-300 transition-all duration-200
              font-mono tracking-wide"
                    placeholder="Contoh: 101">
            </div>

            <!-- Nama Rekening -->
            <div class="lg:col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Rekening (NAMA)</label>
                <input type="text" name="NAMA" required
                    class="w-full rounded-sm border border-gray-300 bg-white 
              py-2 px-3 text-gray-700 placeholder-gray-400 text-xs
              focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 
              hover:border-blue-300 transition-all duration-200"
                    placeholder="Contoh: KAS BESAR">
            </div>

            <!-- Posisi / Group -->
            <div class="lg:col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Posisi (A_P)</label>
                <select name="A_P" required id="selectAP"
                    class="w-full rounded-xl border border-gray-300 bg-white 
               px-4 py-3.5 pr-10 text-gray-700 placeholder-gray-400
               focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 
               hover:border-blue-300 transition-all duration-200
               appearance-none cursor-pointer">
                    <option value="A" class="text-gray-700">A - Aset / Beban</option>
                    <option value="P" class="text-gray-700">P - Pasiva / Pendapatan</option>
                </select>
            </div>

            <!-- Saldo Awal -->
            <div class="lg:col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Saldo Awal (Rp)</label>
                <input type="text" name="SALDO" id="saldoInput" value="0" required
                    class="w-full rounded-sm border border-gray-300 bg-white 
              py-2 px-3 text-gray-700 placeholder-gray-400 text-xs
              focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 
              hover:border-blue-300 transition-all duration-200
              text-right font-mono tracking-tight"
                    placeholder="0">
            </div>

            <!-- Submit Button -->
            <div class="lg:col-span-5 flex justify-end mt-2">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium text-sm">
                    + Simpan Rekening
                </button>
            </div>
        </form>
    </div>

    <!-- Table List Rekening -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 font-medium border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-3">Kode</th>
                        <th class="px-6 py-3">Nama Rekening</th>
                        <th class="px-6 py-3">Posisi</th>
                        <th class="px-6 py-3 text-right">Saldo</th>
                        <th class="px-6 py-3">Update Terakhir</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($rekenings as $rek)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-3 font-medium text-gray-900">{{ $rek->KODER }}</td>
                        <td class="px-6 py-3">{{ $rek->NAMA }}</td>
                        <td class="px-6 py-3">
                            <span
                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium {{ $rek->A_P == 'A' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                {{ $rek->A_P == 'A' ? 'Aset' : 'Pasiva' }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-right font-mono text-gray-700">
                            Rp {{ number_format($rek->SALDO, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-3 text-gray-500 text-xs">
                            {{ $rek->TGL ? $rek->TGL->format('d M Y H:i') : '-' }}
                        </td>
                        <td class="px-6 py-3 text-center flex justify-center space-x-2">
                            <a href="{{ route('rekening.edit', $rek->KODER) }}"
                                class="text-blue-600 hover:text-blue-900 bg-blue-50 p-1.5 rounded-lg transition"
                                title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                    </path>
                                </svg>
                            </a>
                            <form action="{{ route('rekening.destroy', $rek->KODER) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus rekening {{ $rek->NAMA }}?');"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:text-red-900 bg-red-50 p-1.5 rounded-lg transition"
                                    title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            Belum ada data rekening. Silakan tambah baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $('#selectAP').select2({
        placeholder: '-- Pilih Tipe Rekening --',
        allowClear: true,
        width: '100%',
        theme: 'bootstrap-5',
        selectionCssClass: 'select2--small',
        dropdownCssClass: 'select2--small'
    });
    $(document).ready(function() {
        // Format input saldo dengan titik
        $('#saldoInput').on('input', function(e) {
            // Hapus semua karakter non-digit kecuali koma untuk desimal
            let value = this.value.replace(/[^\d]/g, '');

            // Format dengan titik setiap 3 digit dari belakang
            let formatted = '';
            for (let i = value.length; i > 0; i -= 3) {
                formatted = value.slice(Math.max(0, i - 3), i) + (formatted ? '.' : '') + formatted;
            }

            this.value = formatted;
        });

        // Saat form disubmit, hapus format titik sebelum dikirim
        $('form').on('submit', function() {
            let saldoInput = $('#saldoInput');
            let originalValue = saldoInput.val().replace(/\./g, '');
            saldoInput.val(originalValue);
        });

        // Format saldo saat halaman dimuat
        function formatSaldoOnLoad() {
            let saldoInput = $('#saldoInput');
            let value = saldoInput.val().replace(/[^\d]/g, '');

            if (value) {
                let formatted = '';
                for (let i = value.length; i > 0; i -= 3) {
                    formatted = value.slice(Math.max(0, i - 3), i) + (formatted ? '.' : '') + formatted;
                }
                saldoInput.val(formatted);
            }
        }

        formatSaldoOnLoad();
    });
</script>
@endsection