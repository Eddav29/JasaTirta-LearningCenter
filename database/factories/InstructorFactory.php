<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor>
 */
class InstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'specialization' => $this->faker->randomElement([
                'Web Development',
                'Mobile Development',
                'Data Science',
                'Cybersecurity',
                'Cloud Computing',
                'DevOps',
                'AI/Machine Learning',
            ]),
            'education' => $this->faker->randomElement([
                'Bachelor of Computer Science',
                'Master of Information Technology',
                'Bachelor of Software Engineering',
                'Master of Computer Science',
                'Bachelor of Information Systems',
            ]),
            'experience' => $this->faker->numberBetween(1, 20),
            'bio' => $this->faker->paragraph(3),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'instructor_type' => $this->faker->randomElement(['internal', 'vendor']),
            'company' => $this->faker->randomElement(['JTLC', 'Tech Solutions Inc', 'Digital Experts', 'Code Academy', 'Innovation Labs']),
        ];
    }

    /**
     * Indicate that the instructor is internal.
     */
    public function internal(): static
    {
        return $this->state(fn (array $attributes) => [
            'instructor_type' => 'internal',
            'company' => 'JTLC',
        ]);
    }

    /**
     * Indicate that the instructor is vendor.
     */
    public function vendor(): static
    {
        return $this->state(fn (array $attributes) => [
            'instructor_type' => 'vendor',
        ]);
    }
}
