<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run(Faker $faker)
    {
        //uso questo seeder per creare altri utenti fake da aggiungere 
        for ($i = 0; $i < 5; $i++) {
            $newUser = new User();
            $newUser->name = $faker->name();
            $newUser->email = $faker->email();

            //creo una stringa da usare per accedere come passeword
            $string = '12345678';

            //la cripto per salvarla in db
            $newUser->password = Hash::make($string);// Hash::make per criptare la stringa passata
            $newUser->save();
        }
    }
}
