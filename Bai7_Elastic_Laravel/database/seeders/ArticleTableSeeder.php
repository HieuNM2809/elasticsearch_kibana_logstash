<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use Faker\Factory;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create();

        for($i=0; $i<50; $i++) {
          Article::create([
            'title' => $faker->sentence(3),
            'body' => $faker->paragraph(6),
            'tags' => join(',', $faker->words(4))
          ]);
        }
    }
}
