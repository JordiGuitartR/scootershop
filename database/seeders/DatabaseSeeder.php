<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('123456'),
            'admin'=> true,
        ]);

        
        DB::table('categoria')->insert(['nom_categoria' => "Deck"]);
        DB::table('categoria')->insert(['nom_categoria' => "Bar"]);
        DB::table('categoria')->insert(['nom_categoria' => "Wheel"]);
        DB::table('categoria')->insert(['nom_categoria' => "Fork"]);
        DB::table('categoria')->insert(['nom_categoria' => "Grip"]);

        
        DB::table('producte')->insert(['nom' => "Tilt Formula Deck",'descripcio'=>fake()->text(),
        'preu'=>fake()->numberBetween(50,250),
        'categoria_id'=>1]);
        DB::table('producte')->insert(['nom' => "Ethic Lindworm Deck",'descripcio'=>fake()->text(),
        'preu'=>fake()->numberBetween(50,250),
        'categoria_id'=>1]);
        DB::table('producte')->insert(['nom' => "North Campus Bar",'descripcio'=>fake()->text(),
        'preu'=>fake()->numberBetween(50,250),
        'categoria_id'=>2]);
        DB::table('producte')->insert(['nom' => "Tilt Selects Bar",'descripcio'=>fake()->text(),
        'preu'=>fake()->numberBetween(50,250),
        'categoria_id'=>2]);
        DB::table('producte')->insert(['nom' => "River Naturals Wheels",'descripcio'=>fake()->text(),
        'preu'=>fake()->numberBetween(50,250),
        'categoria_id'=>3]);
        DB::table('producte')->insert(['nom' => "Eagle Fly Wheels",'descripcio'=>fake()->text(),
        'preu'=>fake()->numberBetween(50,250),
        'categoria_id'=>3]);
        DB::table('producte')->insert(['nom' => "Prime Maxime Fork",'descripcio'=>fake()->text(),
        'preu'=>fake()->numberBetween(50,250),
        'categoria_id'=>4]);
        DB::table('producte')->insert(['nom' => "North Nada Fork",'descripcio'=>fake()->text(),
        'preu'=>fake()->numberBetween(50,250),
        'categoria_id'=>4]);
        DB::table('producte')->insert(['nom' => "Hellagrip Classic",'descripcio'=>fake()->text(),
        'preu'=>fake()->numberBetween(50,250),
        'categoria_id'=>5]);
        DB::table('producte')->insert(['nom' => "Skatepro Grip",'descripcio'=>fake()->text(),
        'preu'=>fake()->numberBetween(50,250),
        'categoria_id'=>5]);
        

        for($i=0;$i<10;$i++){
            DB::table('comanda')->insert(['user_id' => fake()->numberBetween(1,10), 
            'data_comanda' => fake()->dateTime(),'total'=>fake()->numberBetween(50,500)]);
        }

        for($i=0;$i<10;$i++){
            DB::table('resenya')->insert(['producte_id' =>fake()->numberBetween(1,10),
            'user_id' =>fake()->numberBetween(1,10),'puntuacio'=> fake()->numberBetween(1,6),
            'comentari'=>fake()->text(),'data_resenya'=>fake()->dateTime()]);
        }

        for($i=0;$i<10;$i++){
            DB::table('comanda_producte')->insert(['comanda_id' => fake()->numberBetween(1,10),
            'producte_id' =>fake()->numberBetween(1,10),'quantitat'=> fake()->numberBetween(1,21),
            'preu_unitari'=>fake()->numberBetween(50,251)]);
        }

        

        
    }
}
