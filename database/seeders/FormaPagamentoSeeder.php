<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FormaPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('forma_pagamentos')->insert([
            [
                'id' => 1,
                'descricao' => 'Dinheiro', 
                'diacompra' => NULL,
                'diavencimento' => NULL, 
            ],
            [
                'id' => 2,
                'descricao' => 'Cartão de Crédito',
                'diacompra' => 11,
                'diavencimento' => 20,
            ],
        ]);
    }
}
