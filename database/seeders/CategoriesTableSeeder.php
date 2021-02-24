<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        $faker = \Faker\Factory::create();
        $numParents = rand(5, 10);

        for ($i = 0; $i < $numParents; $i++) {
            $parent = Category::create([
                'name' => $faker->words(2, true),
                'type' => $faker->randomElement(['I', 'O']),
                'parent_id' => null,
                'color' => $faker->safeHexColor,
            ]);
            $numChildren = rand(1, 5);
            for ($j = 0; $j < $numChildren; $j++) {
                Category::create([
                    'name' => $faker->words(2, true),
                    'type' => $parent->type,
                    'parent_id' => $parent->id,
                ]);
            }
        }
    }
}
