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
        $specializations = [
            'Water Quality Testing',
            'Environmental Analysis',
            'Laboratory Management',
            'Sampling Techniques',
            'Field Testing',
            'Quality Control',
            'Microbiology',
            'Pathogen Detection',
            'Food Safety',
            'Chemical Analysis',
            'Instrumentation',
            'Method Development',
            'Training Development',
            'Adult Education',
            'Curriculum Design',
        ];

        $educations = [
            'PhD Environmental Chemistry - UI',
            'PhD Microbiology - NTU Singapore',
            'M.Sc Environmental Science - ITB',
            'M.Sc Chemistry - UGM',
            'S1 Teknik Lingkungan - ITB',
            'S1 Kimia - UI',
            'S1 Biologi - UGM',
            'S1 Pendidikan Kimia - UNJ',
        ];

        $yearsExp = $this->faker->numberBetween(2, 20);

        return [
            'name' => $this->faker->name(),
            'specialization' => $this->faker->randomElement($specializations),
            'education' => $this->faker->randomElement($educations),
            'experience' => $yearsExp.' years',
            'bio' => $this->faker->paragraph(3),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => '+62 '.$this->faker->numerify('###-####-####'),
            'image' => 'https://ui-avatars.com/api/?name='.urlencode($this->faker->name()).'&background=random&size=200',
            'instructor_type' => $this->faker->randomElement(['internal', 'vendor']),
            'company' => null,
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
