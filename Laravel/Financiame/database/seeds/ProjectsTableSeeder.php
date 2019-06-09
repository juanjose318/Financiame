<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i=0; $i <= 50; $i++):
            DB::table('projects')
                ->insert([
                'title' => $faker->sentence($nbWords = 5, $variableNbWords = true),
                'intro' => $faker->text($maxNbChars = 200),
                'content' => $faker->text($maxNbChars = 250),
                'user_id' => $faker->numberBetween($min = 1, $max = 50),
                'category_id' => $faker->numberBetween($min = 1, $max = 6),
                'credit_goal' => $faker->numberBetween($min = 20, $max = 20000),
                'created_at' => $faker->dateTimeBetween($startDate ='-1 monts', $endDate ='now'),
                'updated_at' => $faker->dateTimeBetween($startDate ='-1 monts', $endDate ='now'),
                'initial_time' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now'),
                'final_time' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now'),
                ]);
        endfor;
    }

}
