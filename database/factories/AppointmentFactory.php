<?php

namespace Database\Factories;

use App\Models\Appointment; use Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => Str::random(8),
            'description' => Str::random(20),
            'therapist_id' =>  $this->faker->numberBetween(1,15),
            'therapy_room_id' => $this->faker->numberBetween(1,13),
            'start_at' => $this->faker->dateTimeBetween('2022-03-17 07:31:40','2022-03-18 16:31:40'),
            //'ended_at' => $this->faker->dateTimeBetween('2022-03-19 07:31:40','2022-03-21 16:31:40'),
            'status' =>  'scheduled',
        ];
    }
}
