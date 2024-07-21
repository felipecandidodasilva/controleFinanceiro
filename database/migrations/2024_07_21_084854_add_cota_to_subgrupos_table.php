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
        Schema::table('subgrupos', function (Blueprint $table) {
            $table->decimal('cota', 8, 2)->nullable(); // Adiciona o campo 'cota'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subgrupos', function (Blueprint $table) {
            $table->dropColumn('cota'); // Remove o campo 'cota'
        });
    }
};
