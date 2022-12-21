<?php
/**
 * Eugeny Nosenko 2021
 * https://toprogram.ru
 * info@toprogram.ru
 */

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Comment;
use App\Models\User;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test Index Comment functionality
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::first();
        $this->seed(\CommentsTableSeeder::class);

        $response = $this->actingAs($user)->ajax('get', route('comments.index'));
        $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'current_page',
                'data' => [[
                    'user_name',
                    'publish',
                    'comment',
                    'post_id',
                    
                ]],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'path',
                'per_page',
                'to',
                'total'
            ]
        ])
        ->assertJsonCount(10, 'data.data');
    }

    /**
     * Test Create Comment functionality
     *
     * @return void
     */
    public function testCreate()
    {
        $user = User::first();
        $response = $this->actingAs($user)->get(route('comments.create'));
        $response->assertStatus(200)
        ->assertViewIs('admin.comments.create');
    }

    /**
     * Test Store Comment functionality
     *
     * @return void
     */
    public function testStore()
    {
        $user = User::first();

        $this->seed(\CommentsTableSeeder::class);


        $data = [
            'user_name' => $this->faker->word,
        'publish' => $this->faker->boolean(),
        'comment' => $this->faker->word,
        'post_id' => \App\Models\Post::first()->id,
        
        ];

        $response = $this->actingAs($user)->ajax('post', route('comments.store'), $data);
        $response->assertStatus(201);
        
        $this->assertDatabaseHas('comments', $data);
    }

    /**
     * Test Show Comment functionality
     *
     * @return void
     */
    public function testShow()
    {
        $user = User::first();

        $this->seed(\CommentsTableSeeder::class);

        $comment = Comment::firstOrFail();

        $response = $this->actingAs($user)->ajax('get', route('comments.show', ['comment' => $comment->id]));
        $response->assertStatus(200)
        ->assertViewIs('admin.comments.show');
    }

    /**
     * Test Edit Comment functionality
     *
     * @return void
     */
    public function testEdit()
    {
        $user = User::first();

        $this->seed(\CommentsTableSeeder::class);

        $comment = Comment::firstOrFail();

        $response = $this->actingAs($user)->get(route('comments.edit', ['comment' => $comment->id]));
        $response->assertStatus(200)
        ->assertViewIs('admin.comments.edit');
    }

    /**
     * Test Update Comment functionality
     *
     * @return void
     */
    public function testUpdate()
    {
        $user = User::first();

        $this->seed(\CommentsTableSeeder::class);
        
        $comment = Comment::firstOrFail();

        $data = [
            'user_name' => 'Test Update Comment',
        ];

        $response = $this->actingAs($user)->ajax('put', route('comments.update', ['comment' => $comment->id]), $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('comments', $data);
    }

    /**
     * Test Destroy Comment functionality
     *
     * @return void
     */
    public function testDestroy()
    {
        $user = User::first();

        $this->seed(\CommentsTableSeeder::class);

        $comment = Comment::firstOrFail();

        $response = $this->actingAs($user)->ajax('delete', route('comments.destroy', ['comment' => $comment->id]));
        $response->assertStatus(204);
        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id
        ]);
    }

     /**
     * Test Mass Destroy Comment functionality
     *
     * @return void
     */
     public function testmassdestroy()
     {
         $this->seed(\CommentsTableSeeder::class);
         $user = User::firstOrFail();
         $items = Comment::all()->pluck('id')->toArray();

         $response = $this->actingAs($user)->ajax('post', route('comments.massdestroy'), [
            'selected' => $items
         ]);
         $response->assertStatus(204);
         $this->assertDatabaseMissing('comments', [
            'id' => $items[0]
         ]);
     }
}
