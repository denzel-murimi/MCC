<?php

namespace Database\Factories;

use App\Gender;
use App\Models\Child;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Child>
 */
class ChildFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Child::class;
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name(),
            'dob'=>$this->faker->date('Y-m-d'),
            'gender'=>$this->faker->randomElement(Gender::values()),
            'condition'=>$this->faker->paragraph(),
        ];
    }
}
