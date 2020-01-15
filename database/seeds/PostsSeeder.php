<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Posts::class, 10)->create()->each(function ($posts) {
            $posts->save();
        });
    }
}
