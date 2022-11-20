<?php

namespace Database\Factories;

use App\Models\Salle;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Salle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->text(255),
            'qte' => $this->faker->randomNumber(0),
        ];
    }
}
