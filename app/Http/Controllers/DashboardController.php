<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {

        $dataRekening = Rekening::all(['KODER', 'SALDO']);
        $dataCash = $dataRekening->sum('SALDO');

        $data = [
            'totalAccounts' => count($dataRekening),
            'totalCashBalance' => $dataCash
        ];

        return view('dashboard', $data);
    }
}
