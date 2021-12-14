<?php

namespace Database\Factories;

use App\Models\Gradebook;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradebookFactory extends Factory
{

    protected $model = Gradebook::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
