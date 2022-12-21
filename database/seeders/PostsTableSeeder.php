<?php
/**
 * Eugeny Nosenko 2021
 * https://toprogram.ru
 * info@toprogram.ru
 */

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
         \App\Models\Post::factory(20)->create();
    }
}
