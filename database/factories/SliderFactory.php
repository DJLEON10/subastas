<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this ->faker->title,
            'imagen' => randomImage(),
            'descripcion' => $this -> faker -> text,
            
            'nombre_boton'=> $this->faker->title,
            'link_boton'=> $this->faker->url,
            'registradopor' => \App\Models\User::factory(),
            'estado' => "1",
            'created_at' => now(),
            'updated_at' => now(),
            
        ];
    }
}

function  randomImage(): string
{
    return "proyecto/public/uploads/slider/img" . rand(1, 15) . ".jpg";
}
