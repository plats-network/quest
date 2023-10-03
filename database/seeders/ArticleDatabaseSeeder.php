<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class ArticleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Auth::loginUsingId(1);

        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        /*
         * Category Seed
         * ------------------
         */
        DB::table('categories')->truncate();
        echo "\nTruncate: categories \n";

        Category::factory()->count(5)->create();
        echo " Insert: categories \n\n";

        /*
         * Posts Seed
         * ------------------
         */
        DB::table('tasks')->truncate();
        DB::table('posts')->truncate();
        echo "Truncate: posts \n";

        // Populate the pivot table
        Post::factory()
                ->has(Tag::factory()->count(rand(1, 5)))
                ->count(5)
                ->create();

        echo " Insert: posts \n\n";

        // Artisan::call('auth:permission', [
        //     'name' => 'posts',
        // ]);
        // Artisan::call('auth:permission', [
        //     'name' => 'categories',
        // ]);
        // Artisan::call('auth:permission', [
        //     'name' => 'tags',
        // ]);

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
