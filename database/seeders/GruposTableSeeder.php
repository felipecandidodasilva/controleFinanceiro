<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class GruposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('grupos')->insert([
            [
                'id' => 1,
                'descricao' => 'Grupo 1', 
            ],
            [
                'id' => 2,
                'descricao' => 'Grupo 2', 
            ],
        ]);
    }
}
