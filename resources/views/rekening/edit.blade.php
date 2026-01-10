@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Edit Rekening</h2>
        <p class="text-gray-600 text-sm">Update data rekening: {{ $rekening->KODER }} - {{ $rekening->NAMA }}</p>
    </div>

    <!-- Form Edit Rekening -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form action="{{ route('rekening.update', $rekening->KODER) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Kode Rekening -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kode Rekening (KODER)</label>
                <input type="text" name="KODER" value="{{ old('KODER', $rekening->KODER) }}" required
                    class="w-full rounded-sm border border-gray-300 bg-white 
              py-2 px-3 text-gray-700 placeholder-gray-400
              focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 
              hover:border-blue-300 transition-all duration-200 font-mono tracking-wide"
                    placeholder="Contoh: 101">
                <p class="text-xs text-yellow-600 mt-1">*Mengubah kode rekening akan otomatis mengupdate data di jurnal
                    terkait.</p>
            </div>

            <!-- Nama Rekening -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Rekening (NAMA)</label>
                <input type="text" name="NAMA" value="{{ old('NAMA', $rekening->NAMA) }}" required
                    class="w-full rounded-sm border border-gray-300 bg-white 
              py-2 px-3 text-gray-700 placeholder-gray-400
              focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 
              hover:border-blue-300 transition-all duration-200"
                    placeholder="Contoh: KAS BESAR">
            </div>

            <!-- Posisi / Group -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Posisi (A_P)</label>
                <select name="A_P" required id="selectAP"
                    class="w-full rounded-sm border border-gray-300 bg-white 
               py-2 px-3 pr-10 text-gray-700 placeholder-gray-400
               focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 
               hover:border-blue-300 transition-all duration-200 appearance-none cursor-pointer">
                    <option value="A" {{ old('A_P', $rekening->A_P) == 'A' ? 'selected' : '' }} class="text-gray-700">A - Aktiva</option>
                    <option value="P" {{ old('A_P', $rekening->A_P) == 'P' ? 'selected' : '' }} class="text-gray-700">P - Pasiva</option>
                    <option value="L" {{ old('A_P', $rekening->A_P) == 'L' ? 'selected' : '' }} class="text-gray-700">L - Pendapatan</option>
                    <option value="O" {{ old('A_P', $rekening->A_P) == 'O' ? 'selected' : '' }} class="text-gray-700">O - Biaya</option>
                </select>
            </div>

            <!-- Saldo Awal -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Saldo</label>
                <input type="number" name="SALDO" value="{{ old('SALDO', $rekening->SALDO) }}" required min="0" disabled
                    class="w-full rounded-sm border border-gray-300 bg-white cursor-not-allowed
              py-2 px-3 text-gray-700 placeholder-gray-400
              focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 
              hover:border-blue-300 transition-all duration-200 text-right font-mono tracking-tight">
                <p class="text-xs text-gray-500 mt-1">*Hati-hati mengubah saldo jika transaksi sudah berjalan.</p>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-3 pt-4 border-t mt-4">
                <a href="{{ route('rekening.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm font-medium">Batal</a>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium text-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    $('#selectAP').select2({
        placeholder: '-- Pilih Tipe Rekening --',
        allowClear: true,
        width: '100%',
        theme: 'bootstrap-5'
    });
</script>
@endsection