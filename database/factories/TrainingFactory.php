<?php

namespace Database\Factories;

use App\Models\Instructor;
use App\Models\Training;
use App\Models\TrainingCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Training>
 */
class TrainingFactory extends Factory
{
    protected $model = Training::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $trainingTypes = ['Beginner', 'Intermediate', 'Advanced', 'Expert'];

        return [
            'title' => fake()->sentence(4, true),
            'description' => fake()->paragraph(5),
            'category_id' => TrainingCategory::factory(),
            'instructor_id' => Instructor::factory(),
            'duration' => fake()->randomElement(['8 jam', '16 jam', '24 jam', '40 jam', '80 jam']),
            'price' => fake()->numberBetween(100000, 5000000),
            'capacity' => fake()->numberBetween(10, 50),
            'training_type' => fake()->randomElement($trainingTypes),
            'rating' => fake()->randomFloat(1, 0, 5),
            'review_count' => fake()->numberBetween(0, 500),
            'is_active' => fake()->boolean(80), // 80% chance of being active
        ];
    }

    /**
     * Indicate that the training is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the training is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Indicate that the training is highly rated.
     */
    public function highlyRated(): static
    {
        return $this->state(fn (array $attributes) => [
            'rating' => fake()->randomFloat(1, 4.0, 5.0),
            'review_count' => fake()->numberBetween(50, 500),
        ]);
    }

    /**
     * Indicate that the training is for beginners.
     */
    public function beginner(): static
    {
        return $this->state(fn (array $attributes) => [
            'duration' => fake()->randomElement(['8 jam', '16 jam']),
        ]);
    }

    /**
     * Indicate that the training is advanced.
     */
    public function advanced(): static
    {
        return $this->state(fn (array $attributes) => [
            'duration' => fake()->randomElement(['40 jam', '80 jam']),
        ]);
    }

    /**
     * Indicate that the training is expensive.
     */
    public function expensive(): static
    {
        return $this->state(fn (array $attributes) => [
            'price' => fake()->numberBetween(2000000, 5000000),
        ]);
    }

    /**
     * Indicate that the training is affordable.
     */
    public function affordable(): static
    {
        return $this->state(fn (array $attributes) => [
            'price' => fake()->numberBetween(100000, 1000000),
        ]);
    }

    /**
     * Indicate that the training is online.
     */
    public function online(): static
    {
        return $this->state(fn (array $attributes) => [
            'training_type' => 'online',
        ]);
    }

    /**
     * Indicate that the training is corporate.
     */
    public function corporate(): static
    {
        return $this->state(fn (array $attributes) => [
            'capacity' => fake()->numberBetween(20, 100),
            'price' => fake()->numberBetween(1000000, 10000000),
        ]);
    }
}
