<?php

use Faker\Generator as Faker;
use App\User;
use App\Model\UserInfo;
use Illuminate\Database\Seeder;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // salvo tutti gli user in una variabile
        $users = User::all();

        // faccio un foreach sulla variabile creata
        // in modo da girare su tutti gli user senza mettere un numero preciso 
        foreach ($users as $user) {
            $newUserInfo = new UserInfo();
            $newUserInfo->phone = $faker->phoneNumber(); //faker per numero di telefono
            $newUserInfo->address = $faker->address(); // faker per indirizzo 
            $newUserInfo->user_id = $user->id; // user_id sarà uguale ad user->id

            $newUserInfo->save(); // salvo il tutto 
        }
    }
}
