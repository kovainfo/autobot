<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Essence;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstNameMale(),
            'surname' => $this->faker->lastName(),
            'patronymic' => $this->faker->firstNameMale(),
            'phone_number' => $this->faker->phoneNumber(),
            'approved' => $this->faker->numberBetween(0, 2),
            'id_role' => 1,
            'id_essence' => 1,
            'id_address' => 1,
            'telegram_id' => strval($this->faker->numberBetween(100000000, 999999999)),
            'remember_token' => Str::random(10),
        ];
    }
}
