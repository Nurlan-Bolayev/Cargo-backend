<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'surname' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'birth_date' => '1996/10/24',
            'ID_card_number' => 13404269,
            'IIN' => '6EXZZ6V',
            'gender' => rand(0,1) ? 'male' : 'female',
             'address' => $this->faker->address,
            'delivery_address'=> $this->faker->address,
            'email_verified_at' => now(),
            'phone_number' => '+99455-462-89-54',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
