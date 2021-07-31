<?php

namespace Database\Seeders;

use App\Models\InstallmentFeature;
use App\Models\Ticket;
use Database\Factories\InstallmentFeaturesFactory;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 4; $i++) {
            $parentTicket = Ticket::factory()->create();//parent ticket
            if ($parentTicket->type == 1) {
                for ($c = 0; $c < 2; $c++) {
                    $childTicket = Ticket::factory()->create([
                        'type' => 0,
                        'parent' => $parentTicket,
                        'priceCash'=>5000,
                        'priceInstallment'=>10000,
                        'descriptionTopFactor'=>$this->faker->text(150),
                        'descriptionBottomFactor'=>$this->faker->text(150)
                    ]);
                    InstallmentFeature::factory()->create([
                        'ticket_id' => $childTicket->id
                    ]);
                }
            }else{
                InstallmentFeature::factory()->create([
                    'ticket_id' => $parentTicket->id
                ]);
            }
            $parentTicket->update([
                'priceCash'=>5000,
                'priceInstallment'=>10000,
                'descriptionTopFactor'=>$this->faker->text(150),
                'descriptionBottomFactor'=>$this->faker->text(150)
            ]);
        }
    }
}
