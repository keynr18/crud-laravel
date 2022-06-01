<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' =>$this->faker->sentence(),
            'contenido' =>$this->faker->text(),
            'imagenes'=>$this->faker->image('public/storage/public',680,480,null,false)
        

        ];
    }
}
