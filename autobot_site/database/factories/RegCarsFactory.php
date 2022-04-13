<?php

namespace Database\Factories;

use App\Models\RegCars;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegCars>
 */
class RegCarsFactory extends Factory
{
    protected $model = RegCars::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'num_car' => strval($this->faker->numberBetween(100, 999)),
            'model'=> $this->withfaker()->randomElement(["Audi", "Skoda", "BMW", "Nissan", "Toyota", "Lotus", "Mercedes-Benz", "Mitsubishi", "Mazda", "Seat" ]),
            'owner'=> $this->withFaker()->randomElement([0, 1]),
            'add_info' => $this->withFaker()->randomElement(["Такси", "Частник", "Легковушка", "Цвет - красный"]),
            'dateTime_order' => $this->withFaker()->date(),
            'comment' => $this->withFaker()->randomElement(["Российские номера", "Заграничные номера"]),
            'approved' => 0,
            'id_user' => User::factory()->create(),
        ];
    }
}
