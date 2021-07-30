<?php


namespace App\Repository;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Zarinpal\Laravel\Facade\Zarinpal;

class OrderRipositpry
{
    private $authority;

    public function zarinpal($amount,$ticket)
    {
        $results = Zarinpal::request(
            "http://localhost:8000/order/store/".$ticket,          //required
            $amount,                                  //required
            'testing',                             //required
            'me@example.com',                      //optional
            '09000000000'                        //optional
        /*[                          //optional
            "Wages" => [
                "zp.1.1" => [
                    "Amount" => 120,
                    "Description" => "part 1"
                ],
                "zp.2.5" => [
                    "Amount" => 60,
                    "Description" => "part 2"
                ]
            ]
        ]*/
        );
// save $results['Authority'] for verifying step
        $this->authority = $results['Authority'];

        Zarinpal::redirect(); // redirect user to zarinpal

// after that verify transaction by that $results['Authority']
       dd( Zarinpal::verify('OK', 1000, $results['Authority']));
    }

    public function createOrder($totalAmount,$userInfo,$ticketInfo,$payMethod,$ticket)
    {
        $this->zarinpal($totalAmount,$ticket->id);
        $verifyZarinpal=Zarinpal::verify('OK', $totalAmount, $this->authority);

        if ($verifyZarinpal == 100) {
            Order::create([
                'authority'=>$this->authority,
                'totalAmount' => $totalAmount,
                'userInfo' => $userInfo,
                'ticketInfo' => $ticketInfo,
                'payMethod' => $payMethod,
                'payStatus' => $payMethod ==1 ? 1 : 2,//1=>naghd , 2=>ghesty
                'userId' => Auth::id(),
            ]);
        }else{
            dd($verifyZarinpal);
        }
    }
}
