<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
    public function neraca()
    {
        // Ambil rekening Detail (bukan Header)
        // Aktiva: A, Pasiva: P
        $aktiva = Rekening::where('TIPE', 'D')
            ->where('A_P', 'A')
            ->orderBy('KODER')
            ->get();

        $pasiva = Rekening::where('TIPE', 'D')
            ->where('A_P', 'P')
            ->orderBy('KODER')
            ->get();

        $totalAktiva = $aktiva->sum('SALDO');
        $totalPasiva = $pasiva->sum('SALDO');

        return view('laporan.neraca', compact('aktiva', 'pasiva', 'totalAktiva', 'totalPasiva'));
    }

    public function labarugi()
    {
        // Pendapatan: L, Biaya: O
        $pendapatan = Rekening::where('TIPE', 'D')
            ->where('A_P', 'L')
            ->orderBy('KODER')
            ->get();

        $biaya = Rekening::where('TIPE', 'D')
            ->where('A_P', 'O')
            ->orderBy('KODER')
            ->get();

        $totalPendapatan = $pendapatan->sum('SALDO');
        $totalBiaya = $biaya->sum('SALDO');
        $labaBersih = $totalPendapatan - $totalBiaya;

        return view('laporan.labarugi', compact('pendapatan', 'biaya', 'totalPendapatan', 'totalBiaya', 'labaBersih'));
    }
}
