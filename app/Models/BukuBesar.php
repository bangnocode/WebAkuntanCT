<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuBesar extends Model
{
    protected $table = 'gl_bukubesar';

    protected $fillable = [
        'TGL',
        'TGLVAL',
        'NOSLIP',
        'KODER',
        'DK',
        'KET',
        'SALDOAWAL',
        'DEBIT',
        'KREDIT',
        'SALDO',
        'OPER',
        'UNIT',
    ];

    protected $casts = [
        'TGL' => 'date',
        'TGLVAL' => 'date',
        'SALDOAWAL' => 'decimal:2',
        'DEBIT' => 'decimal:2',
        'KREDIT' => 'decimal:2',
        'SALDO' => 'decimal:2',
    ];

    // Relasi ke Rekening (Optional)
    public function rekening()
    {
        return $this->belongsTo(Rekening::class, 'KODER', 'KODER');
    }
}
