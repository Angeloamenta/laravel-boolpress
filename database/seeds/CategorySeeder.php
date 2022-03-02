<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Model\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 5; $i++) { 
            $newCategory = New Category();
            $newCategory->name = $faker->words(2, true);
            // creo al variabile title che contiene il nome "-"il numero del giro
            $title = "$newCategory->name-$i"; 
            // creo lo slug con il titolo, il numero del giro tutto diviso dai trattini
            $newCategory->slug = Str::slug($title, '-');
            $newCategory->save();
        }
    }
}
