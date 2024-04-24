<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LancamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lancamentos')->insert([
            [
                'id' => 1,
                'descricao' => 'Teste',
                'subgrupo_id' => 1,
                'forma_pagamento_id' => 1,
                'valor' => 100.99,
                'total_parcelas' => 12,
                'dt_compra' => '2024-04-11',
                'tipo_lancamento' => 'S'
            ],
            [
                'id' => 2,
                'descricao' => 'Teste 2 ',
                'subgrupo_id' => 2,
                'forma_pagamento_id' => 2,
                'valor' => 399.99,
                'total_parcelas' => 12,
                'dt_compra' => '2024-04-11',
                'tipo_lancamento' => 'E'
            ],
        ]);
    }
}
