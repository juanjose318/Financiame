<?php

use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for($i =0; $i <= 50; $i++):
            DB::table('users')
                ->insert([
                'name' => $faker->firstName($gender = null),
                'email' => $faker->unique()->safeEmail,
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => str_random(10),
                'credits' => $faker->numberBetween($min = 1, $max = 200),
                'gender' => $faker->randomElement($array = array ('male', 'female')) ,
                ]);
        endfor;
    }
    
}