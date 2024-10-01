<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade'); 
            $table->integer('jumlah');
            $table->decimal('harga_total', 15, 2);
            $table->string('metode_pembayaran');
            $table->timestamp('waktu_transaksi')->useCurrent();
            $table->string('status')->default('selesai'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};