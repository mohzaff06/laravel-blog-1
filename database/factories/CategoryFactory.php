<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected static $categories = [
        'Technology', 'Sports', 'Politics', 'Entertainment',
        'Science', 'Health', 'Travel', 'Food', 'Business'
    ];

    protected static $index = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => static::$categories[static::$index++ % count(static::$categories)],
        ];
    }
}
