<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lancamentos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')->index();
            $table->char('tipo_lancamento',1);
            $table->foreignId('subgrupo_id')->constrained();
            $table->foreignId('forma_pagamento_id')->constrained();
            $table->decimal('valor', total: 8, places: 2);
            $table->Integer('total_parcelas');
            $table->date('dt_compra');
            $table->text('obs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lancamentos');
    }
};
