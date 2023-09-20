<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
//        factory(Article::class, 20)->create();
        Article::factory()
            ->count(20)
            ->create();
    }
}
