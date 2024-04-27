<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Characters;

class charactersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for($i = 0; $i < 10; $i++){
            Characters::create([
                'name'=>$faker->name,
                'image'=>$faker->imageUrl(360, 360),
                'about'=>$faker->sentence
            ]);
        }
    }
}
