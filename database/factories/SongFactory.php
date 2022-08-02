<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [ 
            "artist"=> $this->faker->name, 
            "title" => $this->faker->sentence, 
            "genre"=>$this->faker->sentence, 
            "year"=> "2022", 
            "song"=>$this->faker->sentence."mp3", 
            "cover"=>$this->faker->sentence."png",
            "uploaded_by"=>1
        ];
    }
}
