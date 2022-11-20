<?php

namespace Database\Factories;

use App\Models\Emploi;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmploiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Emploi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Ddebut' => $this->faker->text(255),
            'Dfin' => $this->faker->text(255),
            'classe_id' => \App\Models\Classe::factory(),
            'salle_id' => \App\Models\Salle::factory(),
            'user_id' => \App\Models\User::factory(),
            'prof_id' => \App\Models\Prof::factory(),
        ];
    }
}
