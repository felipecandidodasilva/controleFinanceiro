<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SubgrupostableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subgrupos')->insert([
            [
                'id' => 1,
                'grupo_id' => 1,
                'descricao' => 'SubGrupo 1', 
            ],
            [
                'id' => 2,
                'grupo_id' => 2,
                'descricao' => 'SubGrupo 2', 
            ],
        ]);
    }
}
