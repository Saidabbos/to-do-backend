<?php

use Illuminate\Database\Seeder;
use App\Plans;
class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Plans::truncate();
        $faker =  \Faker\Factory::create();
        for($i=0; $i<=15;  $i++) {
            Plans::create([
                'name'=>$faker->jobTitle,
                'author'=>1,
                'done'=>$faker->boolean(4)
            ]);
        }
    }
}
