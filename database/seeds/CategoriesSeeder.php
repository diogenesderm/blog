<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Categories::class, 10)->create()->each(function ($categories) {
            $categories->posts()->save(factory(App\Posts::class)->make());
        });
    }
}
