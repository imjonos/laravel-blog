<?php

namespace Tests\Feature\Site;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use PostsTableSeeder;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStore()
    {
        $this->seed(PostsTableSeeder::class);
        $post = Post::publish()->first();
        $response = $this->post(route('site.comments.store', ['slug' => $post->slug]),[
            'user_name' => 'test',
            'comment' => 'test'
        ]);

        $response->assertStatus(302);
    }
}
