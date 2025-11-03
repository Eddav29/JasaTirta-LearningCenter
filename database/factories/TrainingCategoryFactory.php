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
                'Analisis Kimia',
                'Analisis Fisika',
                'Quality Control',
                'Quality Assurance',
                'Sistem Manajemen Lab',
                'Audit Internal Lab',
                'Validasi Metode',
                'Verifikasi Metode',
                'Uncertainty Measurement',
                'Good Laboratory Practice',
                'Hazard Analysis',
                'Risk Assessment',
                'Environmental Compliance',
                'Water Treatment Technology',
                'Wastewater Management',
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
