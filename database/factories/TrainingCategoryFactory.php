<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrainingCategory>
 */
class TrainingCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Web Development',
                'Mobile Development',
                'Data Science',
                'Cybersecurity',
                'Cloud Computing',
                'DevOps',
                'AI & Machine Learning',
                'UI/UX Design',
                'Digital Marketing',
                'Project Management',
                'Database Administration',
                'Network Administration',
                'Software Testing',
                'Business Intelligence',
                'E-commerce Development',
            ]),
            'description' => $this->faker->paragraph(2),
        ];
    }

    /**
     * Indicate that the category should have a short description.
     */
    public function shortDescription(): static
    {
        return $this->state(fn (array $attributes) => [
            'description' => $this->faker->sentence(10),
        ]);
    }

    /**
     * Indicate that the category should have no description.
     */
    public function withoutDescription(): static
    {
        return $this->state(fn (array $attributes) => [
            'description' => null,
        ]);
    }
}
