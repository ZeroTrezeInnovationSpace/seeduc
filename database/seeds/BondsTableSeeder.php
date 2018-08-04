<?php

use Illuminate\Database\Seeder;
use App\Bond;

class BondsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $bonds = Bond::whereIn('id', [1,2,3])->get();
        if($bonds->count() >= 3 ){return;}
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
