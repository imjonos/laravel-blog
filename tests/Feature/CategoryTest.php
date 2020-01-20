<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Category;
use App\User;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Index Category functionality
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::first();
        $this->seed(\CategoriesTableSeeder::class);

        $response = $this->actingAs($user)->ajax('get', route('categories.index'));
        $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'current_page',
                'data' => [[
                    'name',
                    'slug',
                    'publish',
                    
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
     * Test Create Category functionality
     *
     * @return void
     */
    public function testCreate()
    {
        $user = User::first();
        $response = $this->actingAs($user)->get(route('categories.create'));
        $response->assertStatus(200)
        ->assertViewIs('admin.categories.create');
    }

    /**
     * Test Store Category functionality
     *
     * @return void
     */
    public function testStore()
    {
        $user = User::first();

        $this->seed(\CategoriesTableSeeder::class);

        $category = Category::firstOrFail();

        $data = [
            'name' => $category->name."newly stored",
            'slug' => 'test'.$category->slug."newly stored",
            'publish' => $category->publish."",
            
        ];

        $response = $this->actingAs($user)->ajax('post', route('categories.store'), $data);
        $response->assertStatus(201);
        
        $this->assertDatabaseHas('categories', $data);
    }

    /**
     * Test Show Category functionality
     *
     * @return void
     */
    public function testShow()
    {
        $user = User::first();

        $this->seed(\CategoriesTableSeeder::class);

        $category = Category::firstOrFail();

        $response = $this->actingAs($user)->ajax('get', route('categories.show', ['category' => $category->id]));
        $response->assertStatus(200)
        ->assertViewIs('admin.categories.show');
    }

    /**
     * Test Edit Category functionality
     *
     * @return void
     */
    public function testEdit()
    {
        $user = User::first();

        $this->seed(\CategoriesTableSeeder::class);

        $category = Category::firstOrFail();

        $response = $this->actingAs($user)->get(route('categories.edit', ['category' => $category->id]));
        $response->assertStatus(200)
        ->assertViewIs('admin.categories.edit');
    }

    /**
     * Test Update Category functionality
     *
     * @return void
     */
    public function testUpdate()
    {
        $user = User::first();

        $this->seed(\CategoriesTableSeeder::class);

        $category = Category::firstOrFail();

        $data = [
            'name' => 'Test Update Category',
        ];

        $response = $this->actingAs($user)->ajax('put', route('categories.update', ['category' => $category->id]), $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', $data);
    }

    /**
     * Test Destroy Category functionality
     *
     * @return void
     */
    public function testDestroy()
    {
        $user = User::first();

        $this->seed(\CategoriesTableSeeder::class);

        $category = Category::firstOrFail();

        $response = $this->actingAs($user)->ajax('delete', route('categories.destroy', ['category' => $category->id]));
        $response->assertStatus(204);
        $this->assertDatabaseMissing('categories', [
            'id' => $category->id
        ]);
    }
}
