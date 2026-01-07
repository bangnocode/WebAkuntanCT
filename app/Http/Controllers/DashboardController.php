<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // Fake data for dashboard summary
        $data = [
            'totalAccounts' => 12,
            'totalCashBalance' => 25000000, // Rp 25.000.000
        ];

        return view('dashboard', $data);
    }
}
