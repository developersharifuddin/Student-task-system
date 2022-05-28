<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Subject::class;
    public function definition()
    {
        return [
               
            //'student_id' => $this->faker->buildingNumber(),
            'name' => $this->faker->name(), 
        ];
    }
}
