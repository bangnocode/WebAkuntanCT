<?php

namespace App\Http\Controllers;

use App\Models\BukuBesar;
use App\Models\Rekening;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-d'));
        $koder = $request->input('koder');

        $query = BukuBesar::query()
            ->join('gl_rekening', 'gl_bukubesar.KODER', '=', 'gl_rekening.KODER')
            ->select('gl_bukubesar.*', 'gl_rekening.NAMA as NAMA_REKENING')
            ->whereDate('gl_bukubesar.TGL', '>=', $startDate)
            ->whereDate('gl_bukubesar.TGL', '<=', $endDate)
            ->orderBy('gl_bukubesar.TGL', 'asc')
            ->orderBy('gl_bukubesar.created_at', 'asc');

        if ($koder) {
            $query->where('gl_bukubesar.KODER', $koder);
        }

        $laporan = $query->get();
        $rekeningList = Rekening::orderBy('KODER')->get();

        return view('laporan.index', compact('laporan', 'rekeningList', 'startDate', 'endDate', 'koder'));
    }
}
