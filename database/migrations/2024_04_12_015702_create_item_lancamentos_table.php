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
        Schema::create('item_lancamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('forma_pagamento_id')->constrained();
            $table->foreignId('lancamento_id')->constrained();
            $table->decimal('valor', total: 8, places: 2);
            $table->Integer('parcela');
            $table->date('dt_vencimento');
            $table->char('pago',1);
            $table->text('obs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_lancamentos');
    }
};
