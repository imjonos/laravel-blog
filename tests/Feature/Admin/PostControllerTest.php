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
use App\Models\Post;
use App\Models\User;

class PostControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test Index Post functionality
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::first();
        $this->seed(\PostsTableSeeder::class);

        $response = $this->actingAs($user)->ajax('get', route('posts.index'));
        $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'current_page',
                'data' => [[
                    'name',
                    'slug',
                    'publish',
                    'preview_text',
                    'detail_text',
                    'category_id',
                    'user_id',
                    
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
     * Test Create Post functionality
     *
     * @return void
     */
    public function testCreate()
    {
        $user = User::first();
        $response = $this->actingAs($user)->get(route('posts.create'));
        $response->assertStatus(200)
        ->assertViewIs('admin.posts.create');
    }

    /**
     * Test Store Post functionality
     *
     * @return void
     */
    public function testStore()
    {
        $user = User::first();

        $this->seed(\PostsTableSeeder::class);


        $data = [
            'name' => $this->faker->name,
        'slug' => $this->faker->unique()->word,
        'publish' => $this->faker->boolean(),
        'preview_text' => $this->faker->word,
        'detail_text' => $this->faker->word,
        'category_id' => \App\Models\Category::first()->id,
        'user_id' => \App\Models\User::first()->id,
        
        ];

        $response = $this->actingAs($user)->ajax('post', route('posts.store'), $data);
        $response->assertStatus(201);
        
        $this->assertDatabaseHas('posts', $data);
    }

    /**
     * Test Show Post functionality
     *
     * @return void
     */
    public function testShow()
    {
        $user = User::first();

        $this->seed(\PostsTableSeeder::class);

        $post = Post::firstOrFail();

        $response = $this->actingAs($user)->ajax('get', route('posts.show', ['post' => $post->id]));
        $response->assertStatus(200)
        ->assertViewIs('admin.posts.show');
    }

    /**
     * Test Edit Post functionality
     *
     * @return void
     */
    public function testEdit()
    {
        $user = User::first();

        $this->seed(\PostsTableSeeder::class);

        $post = Post::firstOrFail();

        $response = $this->actingAs($user)->get(route('posts.edit', ['post' => $post->id]));
        $response->assertStatus(200)
        ->assertViewIs('admin.posts.edit');
    }

    /**
     * Test Update Post functionality
     *
     * @return void
     */
    public function testUpdate()
    {
        $user = User::first();

        $this->seed(\PostsTableSeeder::class);
        
        $post = Post::firstOrFail();

        $data = [
            'name' => 'Test Update Post',
        ];

        $response = $this->actingAs($user)->ajax('put', route('posts.update', ['post' => $post->id]), $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', $data);
    }

    /**
     * Test Destroy Post functionality
     *
     * @return void
     */
    public function testDestroy()
    {
        $user = User::first();

        $this->seed(\PostsTableSeeder::class);

        $post = Post::firstOrFail();

        $response = $this->actingAs($user)->ajax('delete', route('posts.destroy', ['post' => $post->id]));
        $response->assertStatus(204);
        $this->assertDatabaseMissing('posts', [
            'id' => $post->id
        ]);
    }

     /**
     * Test Mass Destroy Post functionality
     *
     * @return void
     */
     public function testmassdestroy()
     {
         $this->seed(\PostsTableSeeder::class);
         $user = User::firstOrFail();
         $items = Post::all()->pluck('id')->toArray();

         $response = $this->actingAs($user)->ajax('post', route('posts.massdestroy'), [
            'selected' => $items
         ]);
         $response->assertStatus(204);
         $this->assertDatabaseMissing('posts', [
            'id' => $items[0]
         ]);
     }
}
