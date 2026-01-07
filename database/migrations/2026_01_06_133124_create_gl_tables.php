<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel Master Rekening
        Schema::create('gl_rekening', function (Blueprint $table) {
            $table->string('KODER')->primary(); // Kode Rekening (Primary)
            $table->string('NAMA');
            $table->decimal('SALDO', 20, 2)->default(0);
            $table->char('A_P', 1); // Group: A = Asset/Harta/Beban, P = Pasiva/Hutang/Modal/Pendapatan
            $table->dateTime('TGL');
            $table->timestamps();
        });

        // Tabel Buku Besar / Jurnal
        Schema::create('gl_bukubesar', function (Blueprint $table) {
            $table->id();
            $table->date('TGL');
            $table->date('TGLVAL');
            $table->string('NOSLIP')->index();
            $table->string('KODER');
            $table->char('DK', 1); // D = Debet, K = Kredit
            $table->text('KET');
            $table->decimal('SALDOAWAL', 20, 2)->default(0);
            $table->decimal('DEBIT', 20, 2)->default(0);
            $table->decimal('KREDIT', 20, 2)->default(0);
            $table->decimal('SALDO', 20, 2)->default(0); // Saldo akhir setelah transaksi
            $table->string('OPER'); // User operator
            $table->string('UNIT')->nullable();

            // Relasi ke tabel rekening
            $table->foreign('KODER')
                ->references('KODER')
                ->on('gl_rekening')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gl_bukubesar');
        Schema::dropIfExists('gl_rekening');
    }
};
