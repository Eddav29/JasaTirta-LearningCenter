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
                'ISO 17025 Lead Auditor',
                'Water Quality Specialist',
                'Environmental Consultant',
                'Sampling Technician Level II',
                'Quality Control Specialist',
                'Microbiologist Certified',
                'Food Safety Auditor',
                'HACCP Lead Auditor',
                'Analytical Chemist',
                'Instrument Specialist',
                'Certified Trainer',
                'Adult Education Specialist',
                'Environmental Management Systems',
                'Laboratory Safety Officer',
                'Chemical Hygiene Officer',
                'Wastewater Treatment Specialist',
                'Air Quality Monitoring Certified',
                'Soil Analysis Expert',
                'GC-MS Operation Certified',
                'HPLC Specialist',
            ]),
        ];
    }
}
