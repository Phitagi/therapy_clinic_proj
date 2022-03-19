<?php

namespace Database\Factories;

use App\Models\Therapy_room;
use Illuminate\Database\Eloquent\Factories\Factory;

class Therapy_roomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Therapy_room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' =>'room',
        ];
    }
}
