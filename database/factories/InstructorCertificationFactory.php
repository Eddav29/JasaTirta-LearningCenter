<?php

namespace Database\Factories;

use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InstructorCertification>
 */
class InstructorCertificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'instructor_id' => Instructor::factory(),
            'certification_name' => $this->faker->randomElement([
                'Laravel Certified Developer',
                'PHP Expert',
                'AWS Certified Solutions Architect',
                'Google Cloud Professional',
                'Microsoft Azure Fundamentals',
                'Certified Kubernetes Administrator',
                'Docker Certified Associate',
                'React Developer Certification',
                'Vue.js Certified',
                'Node.js Professional',
                'Python Certified Developer',
                'Java Oracle Certified',
                'Scrum Master Certified',
                'DevOps Professional',
                'Cybersecurity Specialist',
            ]),
        ];
    }
}
