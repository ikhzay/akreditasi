<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubMenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_menu' => mt_rand(1, 5),
            'nama_submenu' => $this->faker->name(),
        ];
    }
}
