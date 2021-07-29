<?php

namespace Database\Factories;

use App\Models\InstallmentFeature;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstallmentFeatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InstallmentFeature::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'installmentNum'=>rand(6,20),
            'installmentTime'=>rand(3,48),
            'prepayment'=>rand(4000,8000),
            'ticket_id'=>0
        ];
    }
}
