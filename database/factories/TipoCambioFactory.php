<?php

namespace Database\Factories;

use App\Models\TipoCambio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TipoCambioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TipoCambio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fecha' => $this->faker->date(),
            'tc_venta' => mt_Rand (3*1000, 4*1000) / 1000,
            'tc_compra' => mt_Rand (3*1000, 4*1000) / 1000,
        ];
    }
}
