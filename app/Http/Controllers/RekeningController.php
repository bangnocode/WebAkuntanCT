<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    public function index()
    {
        $rekenings = Rekening::orderBy('KODER', 'asc')->get();
        return view('rekening.index', compact('rekenings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'KODER' => 'required|unique:gl_rekening,KODER',
            'NAMA' => 'required|string|max:255',
            // 'SALDO' => 'required|numeric',
            'A_P' => 'required|in:A,P,L,O',
            'TIPE' => 'required|in:H,D',
        ], [
            'KODER.required' => 'Kode Rekening wajib diisi',
            'KODER.unique' => 'Kode Rekening sudah digunakan',
            'NAMA.required' => 'Nama Rekening wajib diisi',
            // 'SALDO.required' => 'Saldo awal wajib diisi',
            // 'SALDO.numeric' => 'Saldo harus berupa angka',
            'A_P.required' => 'Posisi rekening wajib dipilih',
            'A_P.in' => 'Posisi rekening tidak valid (A, P, L, O)',
            'TIPE.required' => 'Tipe rekening wajib dipilih',
            'TIPE.in' => 'Tipe rekening tidak valid (H, D)',
        ]);

        Rekening::create([
            'KODER' => $validated['KODER'],
            'NAMA' => $validated['NAMA'],
            'SALDO' => 0,
            'A_P' => $validated['A_P'],
            'TIPE' => $validated['TIPE'],
            'TGL' => now(),
        ]);

        return redirect()->route('rekening.index')->with('success', 'Rekening berhasil ditambahkan');
    }

    public function edit($id)
    {
        $rekening = Rekening::findOrFail($id);
        return view('rekening.edit', compact('rekening'));
    }

    public function update(Request $request, $id)
    {
        $rekening = Rekening::findOrFail($id);

        $validated = $request->validate([
            'KODER' => 'required|unique:gl_rekening,KODER,' . $id . ',KODER',
            'NAMA' => 'required|string|max:255',
            'A_P' => 'required|in:A,P,L,O',
            // Saldo sebaiknya tidak di-edit sembarangan jika sudah berjalan, tapi untuk awal boleh
            'SALDO' => 'required|numeric',
        ]);

        $rekening->update([
            'KODER' => $validated['KODER'],
            'NAMA' => $validated['NAMA'],
            'SALDO' => $validated['SALDO'],
            'A_P' => $validated['A_P'],
            // TGL updated at default
        ]);

        return redirect()->route('rekening.index')->with('success', 'Rekening berhasil diperbarui');
    }

    public function destroy($id)
    {
        $rekening = Rekening::findOrFail($id);

        // Cek apakah rekening sudah dipakai di Buku Besar
        $isUsed = \App\Models\BukuBesar::where('KODER', $id)->exists();

        if ($isUsed) {
            return back()->with('error', 'Gagal hapus! Rekening ini sudah memiliki transaksi jurnal.');
        }

        $rekening->delete();

        return redirect()->route('rekening.index')->with('success', 'Rekening berhasil dihapus');
    }
}
