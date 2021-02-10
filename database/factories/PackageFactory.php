<?php

namespace Database\Factories;
use App\Models\OverseasAddress;
use App\Models\User;
use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Package::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner_id' => User::factory(),
            'start_point_id' => OverseasAddress::factory(),
            'order_date' => '05/02/2021',
            'price' => 10,
            'weight' => 2,
            'shipping_price' => 2,
            'dimensions' => '2x2x2',
            'guarantee' => false,
            'product_description' => $this->faker->text,
            'status' => 'waiting'
        ];
    }
}
