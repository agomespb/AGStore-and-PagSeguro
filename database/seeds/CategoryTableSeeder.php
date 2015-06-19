<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints

        factory('AGStore\Models\Category')->create([
            'name' => "LANÇAMENTOS",
            'description' => 'Personalização que permiti você montar o seu modelo como bem entender, com tamanhos e modelos diferentes.'
        ]);

        factory('AGStore\Models\Category')->create([
            'name' => "SUTIÃS / Reda",
            'description' => 'Conforto e segurança'
        ]);

        factory('AGStore\Models\Category')->create([
            'name' => "CALCINHAS / Algodão",
            'description' => 'IDEAL PARA USAR NO DIA A DIA'
        ]);

        factory('AGStore\Models\Category')->create([
            'name' => "CALCINHAS / Reda",
            'description' => 'Para ocasiões especiais'
        ]);

        factory('AGStore\Models\Category')->create([
            'name' => "CONJUNTO Com Calcinha",
            'description' => '.'
        ]);
        factory('AGStore\Models\Category')->create([
            'name' => "CONJUNTO Com Fio Dental",
            'description' => '.'
        ]);
        factory('AGStore\Models\Category')->create([
            'name' => "CONJUNTO Com Caleçon",
            'description' => '.'
        ]);
        factory('AGStore\Models\Category')->create([
            'name' => "CONJUNTO Com Tanga",
            'description' => '.'
        ]);

    }
}
