<?php

namespace Database\Factories;

use App\Enums\CategoryStatus;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->words(2, true),
            'is_featured' => fake()->boolean(30),
            'is_menu' => fake()->boolean(70),
            'status' => CategoryStatus::Active,
        ];
    }

    /**
     * Indicate that the category is featured on the storefront.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    /**
     * Indicate that the category appears in the navigation menu.
     */
    public function inMenu(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_menu' => true,
        ]);
    }

    /**
     * Indicate that the category is deactive.
     */
    public function deactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => CategoryStatus::Deactive,
        ]);
    }
}
