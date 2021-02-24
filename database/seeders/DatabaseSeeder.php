<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Transaction::truncate();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $faker = \Faker\Factory::create();

        // Seed categories
        $numParents = rand(5, 10);
        $subcategories = [];
        for ($i = 0; $i < $numParents; $i++) {
            $parent = Category::create([
                'name' => ucwords($faker->words(rand(1, 2), true)),
                'type' => $faker->randomElement(['I', 'O']),
                'parent_id' => null,
                'color' => $faker->safeHexColor,
            ]);
            $numChildren = rand(1, 5);
            for ($j = 0; $j < $numChildren; $j++) {
                $category = Category::create([
                    'name' => ucwords($faker->words(rand(1, 2), true)),
                    'type' => $parent->type,
                    'parent_id' => $parent->id,
                ]);
                $subcategories[] = $category->id;
            }
        }

        // Seed transactions
        for ($i = 0; $i < 100; $i++) {
            Transaction::create([
                'title' => ucfirst($faker->words(rand(1, 3), true)),
                'description' => $faker->sentence,
                'datetime' => $faker->dateTimeBetween('-1 year'),
                'category_id' => $faker->randomElement($subcategories),
            ]);
        }
    }
}
