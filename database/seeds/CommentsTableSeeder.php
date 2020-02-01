<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(App\Comment::class, 20)->create();
    }
}
