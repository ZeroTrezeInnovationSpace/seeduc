<?php

use Illuminate\Database\Seeder;

class BondsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('bonds')->insert([
    		'name' => 'Professores, Gestores e Funcionarios SEDUC',
    		
    	]);
    	DB::table('bonds')->insert([
    		'name' => 'Escola Total, Tempo Integral e Subvencionadas',
    	]);
    	DB::table('bonds')->insert([
    		'name' => 'Publico Externo',
    	]);
    }
}
