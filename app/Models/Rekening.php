<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    protected $table = 'gl_rekening';
    protected $primaryKey = 'KODER';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'KODER',
        'NAMA',
        'SALDO',
        'A_P',
        'TGL',
    ];

    protected $casts = [
        'SALDO' => 'decimal:2',
        'TGL' => 'datetime',
    ];
}
