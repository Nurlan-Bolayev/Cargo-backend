<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\OverseasAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class OverseasAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OverseasAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country' => 'turkey',
            'additional' => json_encode([
                'province' => 'Istanbul',
                'Mahalle' => 'Bagcilar'
            ]),
            'address' => 'ciftcioglu',
            'ID_card_number' => '123456788',
            'phone_number' => '+9057378823929'
        ];
    }
}
