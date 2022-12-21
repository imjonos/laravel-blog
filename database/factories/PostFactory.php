<?php
/**
 * Eugeny Nosenko 2021
 * https://toprogram.ru
 * info@toprogram.ru
 */
 
namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        'slug' => $this->faker->unique()->word,
        'publish' => $this->faker->boolean(),
        'preview_text' => $this->faker->word,
        'detail_text' => $this->faker->word,
        'category_id' => \App\Models\Category::first()->id,
        'user_id' => \App\Models\User::first()->id,
        
        ];
    }
}

