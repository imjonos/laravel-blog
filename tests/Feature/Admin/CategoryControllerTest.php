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
use App\Models\Category;
use App\Models\User;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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


        $data = [
            'name' => $this->faker->name,
        'slug' => $this->faker->unique()->word,
        'publish' => $this->faker->boolean(),
        
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

     /**
     * Test Mass Destroy Category functionality
     *
     * @return void
     */
     public function testmassdestroy()
     {
         $this->seed(\CategoriesTableSeeder::class);
         $user = User::firstOrFail();
         $items = Category::all()->pluck('id')->toArray();

         $response = $this->actingAs($user)->ajax('post', route('categories.massdestroy'), [
            'selected' => $items
         ]);
         $response->assertStatus(204);
         $this->assertDatabaseMissing('categories', [
            'id' => $items[0]
         ]);
     }
}
