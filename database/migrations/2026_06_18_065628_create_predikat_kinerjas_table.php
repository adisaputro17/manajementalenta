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
        Schema::create('predikat_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais')->cascadeOnDelete();
            $table->year('tahun');
            $table->integer('nilai');
            $table->string('keterangan')->nullable();
            // Status approval
            $table->enum('row_status', [
                'PENDING',
                'APPROVED',
                'REJECTED'
            ])->default('PENDING');
            // Informasi approval
            $table->foreignId('approved_by')->nullable()->constrained('pegawais')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            // Alasan penolakan
            $table->text('reject_reason')->nullable();
            $table->timestamps();
            $table->unique([
                'pegawai_id',
                'tahun'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predikat_kinerjas');
    }
};
