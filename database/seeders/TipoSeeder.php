<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_despesa')->insert(
            [
                'descricao' => 'Alimentação',
                'ativo' => true,
            ]
        );

        DB::table('tipo_despesa')->insert(
            [
                'descricao' => 'Entretenimento',
                'ativo' => true,
            ]
        );

        DB::table('tipo_despesa')->insert(
            [
                'descricao' => 'Lazer',
                'ativo' => true,
            ]
        );

        DB::table('tipo_despesa')->insert(
            [
                'descricao' => 'Contas',
                'ativo' => true,
            ]
        );

        DB::table('tipo_despesa')->insert(
            [
                'descricao' => 'Outros',
                'ativo' => true,
            ]
        );
    }
}
