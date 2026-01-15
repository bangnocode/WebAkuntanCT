<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
    public function neraca()
    {
        $accounts = Rekening::orderBy('KODER')->get();

        // Aktiva: A, Pasiva: P
        $neracaAccounts = $accounts->filter(function ($item) {
            return in_array($item->A_P, ['A', 'P']);
        });

        // Split into Aktiva and Pasiva for separate tables/sections if needed
        // OR process them all together? The view expected separate variables.
        // Let's process hierarchies separately for Aktiva and Pasiva to keep the side-by-side or distinct section layout.

        $aktivaRaw = $neracaAccounts->where('A_P', 'A');
        $pasivaRaw = $neracaAccounts->where('A_P', 'P');

        $aktiva = $this->processHierarchy($aktivaRaw);
        $pasiva = $this->processHierarchy($pasivaRaw);

        $totalAktiva = $neracaAccounts->where('A_P', 'A')->where('TIPE', 'D')->sum('SALDO');
        $totalPasiva = $neracaAccounts->where('A_P', 'P')->where('TIPE', 'D')->sum('SALDO');

        return view('laporan.neraca', compact('aktiva', 'pasiva', 'totalAktiva', 'totalPasiva'));
    }

    public function labarugi()
    {
        $accounts = Rekening::orderBy('KODER')->get();

        // Pendapatan: L, Biaya: O
        $labarugiAccounts = $accounts->filter(function ($item) {
            return in_array($item->A_P, ['L', 'O']);
        });

        $pendapatanRaw = $labarugiAccounts->where('A_P', 'L');
        $biayaRaw = $labarugiAccounts->where('A_P', 'O');

        $pendapatan = $this->processHierarchy($pendapatanRaw);
        $biaya = $this->processHierarchy($biayaRaw);

        $totalPendapatan = $labarugiAccounts->where('A_P', 'L')->where('TIPE', 'D')->sum('SALDO');
        $totalBiaya = $labarugiAccounts->where('A_P', 'O')->where('TIPE', 'D')->sum('SALDO');
        $labaBersih = $totalPendapatan - $totalBiaya;

        return view('laporan.labarugi', compact('pendapatan', 'biaya', 'totalPendapatan', 'totalBiaya', 'labaBersih'));
    }

    public function cetakPdf(Request $request)
    {
        $accounts = Rekening::orderBy('KODER')->get();
        $type = $request->query('type', 'all'); // 'neraca', 'labarugi', or 'all'

        $neracaAccounts = collect([]);
        $labarugiAccounts = collect([]);

        // Filter based on type
        if ($type === 'all' || $type === 'neraca') {
            $neracaAccounts = $accounts->filter(function ($item) {
                return in_array($item->A_P, ['A', 'P']);
            });
        }

        if ($type === 'all' || $type === 'labarugi') {
            $labarugiAccounts = $accounts->filter(function ($item) {
                return in_array($item->A_P, ['L', 'O']);
            });
        }

        $processedNeraca = $neracaAccounts->isNotEmpty() ? $this->processHierarchy($neracaAccounts) : collect([]);
        $processedLabaRugi = $labarugiAccounts->isNotEmpty() ? $this->processHierarchy($labarugiAccounts) : collect([]);

        // Calculate Totals
        $totalAktiva = $neracaAccounts->where('A_P', 'A')->where('TIPE', 'D')->sum('SALDO');
        $totalPasiva = $neracaAccounts->where('A_P', 'P')->where('TIPE', 'D')->sum('SALDO');
        $totalNeraca = $totalAktiva - $totalPasiva;

        $totalPendapatan = $labarugiAccounts->where('A_P', 'L')->where('TIPE', 'D')->sum('SALDO');
        $totalBiaya = $labarugiAccounts->where('A_P', 'O')->where('TIPE', 'D')->sum('SALDO');
        $labaBersih = $totalPendapatan - $totalBiaya;

        return view('laporan.pdf', [
            'neraca' => $processedNeraca,
            'labarugi' => $processedLabaRugi,
            'totalNeraca' => $totalNeraca,
            'labaBersih' => $labaBersih,
            'type' => $type
        ]);
    }

    private function processHierarchy($accounts)
    {
        // Turn into keyed collection for easy access
        $keyed = $accounts->keyBy('KODER');

        // 1. Build Tree Structure
        $level3 = [];
        $level2 = [];
        $level1 = [];

        // Classify first, ensuring correct level assignment
        foreach ($accounts as $account) {
            $code = $account->KODER;
            $account->children = collect([]); // Initialize children

            if (substr($code, -5) === '00000') {
                $account->level = 1;
                $account->class = 'level-1';
                $level1[$code] = $account;
            } elseif (substr($code, -3) === '000') {
                $account->level = 2;
                $account->class = 'level-2';
                $level2[$code] = $account;
            } else {
                $account->level = 3;
                $account->class = 'level-3';
                $level3[$code] = $account;
            }
        }

        // 2. Associate and Sum (Bottom Up)

        // Process Level 3
        foreach ($level3 as $code => $l3) {
            // Determine parents
            $parts = explode('-', $code);
            if (count($parts) < 2) continue;

            $prefix = $parts[0];
            $suffix = $parts[1];

            // Potential Parent Level 2: Prefix-XX000
            $parentSuffixL2 = substr($suffix, 0, 2) . '000';
            $parentCodeL2 = $prefix . '-' . $parentSuffixL2;

            if (isset($level2[$parentCodeL2])) {
                // Attach to Level 2
                $level2[$parentCodeL2]->children->push($l3);
            } else {
                // Orphan Level 3 -> Attach directly to Level 1
                $parentCodeL1 = $prefix . '-00000';
                if (isset($level1[$parentCodeL1])) {
                    $level1[$parentCodeL1]->children->push($l3);
                }
            }
        }

        // Calculations for Level 2
        foreach ($level2 as $code => $l2) {
            if ($l2->children->isNotEmpty()) {
                $l2->SALDO = $l2->children->sum('SALDO');
            }

            // Register Level 2 to Level 1
            $parts = explode('-', $code);
            $prefix = $parts[0];
            $parentCodeL1 = $prefix . '-00000';

            if (isset($level1[$parentCodeL1])) {
                $level1[$parentCodeL1]->children->push($l2);
            }
        }

        // Calculations for Level 1
        foreach ($level1 as $l1) {
            if ($l1->children->isNotEmpty()) {
                $l1->SALDO = $l1->children->sum('SALDO');
            }
        }

        // 3. Flatten for View (Recursive or iterative)
        // Since we allowed orphans on L1, L1 children can be L2 OR L3.
        // We need a robust flattener.

        $flattened = collect([]);
        foreach ($level1 as $l1) {
            $flattened->push($l1);

            // Sort children by KODER to keep order
            $sortedChildren = $l1->children->sortBy('KODER');

            foreach ($sortedChildren as $child) {
                $flattened->push($child);

                // If this child is Level 2 and has children (Level 3s)
                if ($child->level === 2 && $child->children->isNotEmpty()) {
                    foreach ($child->children->sortBy('KODER') as $grandChild) {
                        $flattened->push($grandChild);
                    }
                }
            }
        }

        return $flattened;
    }
}
