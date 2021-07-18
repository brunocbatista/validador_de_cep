<?php

namespace Database\Factories;

use App\Models\Cep;
use Illuminate\Database\Eloquent\Factories\Factory;

class CepFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cep::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => "523563",
            'city' => $this->faker->city(),
            'state' => $this->faker->countryCode()
        ];
    }
}
