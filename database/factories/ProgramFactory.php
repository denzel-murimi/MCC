<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Program::class;
    public function definition(): array
    {
        return [
           'author'=>$this->faker->name(),
           'title'=>$this->faker->sentence(),
           'description'=>$this->faker->paragraph(),
           'content'=>$this->faker->text(),
           'event_id'=>1,
           'slug'=>null,
        ];
    }
}
