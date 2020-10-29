<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $faker->numberBetween(1,300),
            'follower_user_id' => $this->$faker->numberBetween(1,300),
            'created_at' => $this->$faker->date,
            'updated_at' => $this->$faker->date,
        ];
    }
}
