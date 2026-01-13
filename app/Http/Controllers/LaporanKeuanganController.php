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

    public function cetakPdf()
    {
        $accounts = Rekening::orderBy('KODER')->get();

        // Separate collections
        // Neraca: A (Aktiva), P (Pasiva), M (Modal/Equity? - Assuming P covers liabilities and equity based on context, otherwise check logic)
        // Adjust based on user files: A_P columns. 
        // Based on neraca(): A and P.
        // Based on labarugi(): L and O.

        $neracaAccounts = $accounts->filter(function ($item) {
            return in_array($item->A_P, ['A', 'P']);
        });

        $labarugiAccounts = $accounts->filter(function ($item) {
            return in_array($item->A_P, ['L', 'O']);
        });

        $processedNeraca = $this->processHierarchy($neracaAccounts);
        $processedLabaRugi = $this->processHierarchy($labarugiAccounts);

        // Calculate Totals for Summary
        // Note: processHierarchy returns flattened list with calculated saldos.
        // We need to sum Level 1 items for the Grand Total? 
        // Or closer: 
        // Total Neraca = (Total Aktiva - Total Pasiva) or just sum of all? 
        // Conventionally: Assets (Debit) - Liabilities (Credit). 
        // If 'SALDO' is signed correctly, sum is enough. If all positive, we need logic.
        // Usually Assets are Debit (+), Liabilities Credit (-).
        // Let's assume standard behavior or check 'A_P'

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
            'labaBersih' => $labaBersih
        ]);
    }

    private function processHierarchy($accounts)
    {
        // Turn into keyed collection for easy access
        $keyed = $accounts->keyBy('KODER');
        $tree = [];

        // 1. Build Tree Structure (Assign children to parents)
        // We will separate into levels to process bottom-up for sums
        $level3 = [];
        $level2 = [];
        $level1 = [];

        foreach ($accounts as $account) {
            $code = $account->KODER;
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
            $account->children = collect([]);
        }

        // 2. Associate and Sum (Bottom Up)

        // Process Level 3 -> Level 2
        foreach ($level3 as $code => $l3) {
            $parentCode = substr($code, 0, 2) . '000'; // e.g. 1-10001 -> 1-10 (approx pattern)
            // Wait, format is X-XXXXX. 
            // Example: 1-10001. 
            // Parent level 2: 1-10000.  (First 4 chars + '0')?
            // User said:
            // Level 2: X-XX000 (e.g. 1-10000)
            // Level 3: X-XXXXX (e.g. 1-10001)
            // So parent of 1-10001 is 1-10000.
            // Logic: Take first 4 chars, append '0' ??
            // 1-10001 -> 1-10 (4 chars) + '0' -> 1-100 is not right.
            // 1-10001 is 7 chars. 
            // '1-100'00.
            // Let's assume the prefix defines parent.

            // Regex/String manipulation:
            // If code is "A-BBCCC", parent level 2 is "A-BB000".
            $parts = explode('-', $code); // ['1', '10001']
            if (count($parts) < 2) continue;

            $prefix = $parts[0]; // '1'
            $suffix = $parts[1]; // '10001'

            // Parent Level 2 Suffix: First 2 chars of suffix + '000'
            $parentSuffixL2 = substr($suffix, 0, 2) . '000';
            $parentCodeL2 = $prefix . '-' . $parentSuffixL2;

            if (isset($level2[$parentCodeL2])) {
                $level2[$parentCodeL2]->children->push($l3);
                // Accumulate Sum if parent saldo is user-managed or zero.
                // Assuming we want calculated sum displayed for parents:
                // $level2[$parentCodeL2]->SALDO += $l3->SALDO; 
                // However, doing this blindly might double count if DB already updated.
                // Decision: Calculate fresh sum for the report to guarantee consistency with details.
                // We will OVERWRITE parent saldo with sum of children for the report view.
            }
        }

        // Sum Level 2
        foreach ($level2 as $l2) {
            if ($l2->children->isNotEmpty()) {
                $l2->SALDO = $l2->children->sum('SALDO');
            }
        }

        // Process Level 2 -> Level 1
        foreach ($level2 as $code => $l2) {
            $parts = explode('-', $code);
            $prefix = $parts[0];
            $parentCodeL1 = $prefix . '-00000';

            if (isset($level1[$parentCodeL1])) {
                $level1[$parentCodeL1]->children->push($l2);
            }
        }

        // Sum Level 1
        foreach ($level1 as $l1) {
            if ($l1->children->isNotEmpty()) {
                $l1->SALDO = $l1->children->sum('SALDO');
            }
        }

        // 3. Flatten for View (Ordered)
        $flattened = collect([]);
        foreach ($level1 as $l1) {
            $flattened->push($l1);
            foreach ($l1->children as $l2) {
                $flattened->push($l2);
                foreach ($l2->children as $l3) {
                    $flattened->push($l3);
                }
            }
        }

        return $flattened;
    }
}
