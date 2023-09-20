<?php

///** @var \Illuminate\Database\Eloquent\Factory $factory */

//use App\Models\Article;
//use Faker\Generator as Faker;
//
//$factory->define(Article::class, function (Faker $faker) {
//    return [
//        'user_id' => rand(1, 3),
//        'title' => $faker->sentence(4),
//        'body' => $faker->paragraph(5),
//        'published' => rand(0, 1)
//    ];
//});

namespace Database\Factories;

use App\Models\Article;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 3),
            'title' => fake()->sentence(4),
            'body' => fake()->paragraph(2),
            'published' => rand(0, 1)
        ];
    }
}
