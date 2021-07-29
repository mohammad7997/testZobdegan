<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /*
        $image=$this->faker->image;
        Storage::disk('public')->putFileAs('',$image,$image);
        $urlImage=Storage::url($image);*/
        return [
            'title'=>$this->faker->title,
            'image'=>$this->faker->imageUrl,
            'property'=>serialize(['test'=>'test']),
            'description'=>$this->faker->text(100),
            'type'=>rand(0,1),
            'parent'=>0,
            'priceCash'=>null,
            'priceInstallment'=>null
        ];
    }
}
