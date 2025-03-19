<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), // Tạo user tự động
            'title' => $this->faker->sentence(),
            'slug' => Str::slug($this->faker->sentence()),
            'description' => $this->faker->text(200),
            'content' => $this->faker->paragraphs(3, true),
            'publish_date' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement([0, 1, 2]),
            'thumbnail' => null, // Hoặc có thể là 'thumbnails/default.png'
        ];
    }
}
