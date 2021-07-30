<?php


namespace App\Repository;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Zarinpal\Laravel\Facade\Zarinpal;

class OrderRipositpry
{
    public $authority;

    public function getAuthority($amount)
    {
        $results = Zarinpal::request(
            "http://localhost:8000/order/verify",          //required
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

        $this->authority = $results['Authority'];
    }

    public function zarinpal()
    {
        Zarinpal::redirect(); // redirect user to zarinpal
// after that verify transaction by that $results['Authority']
        // dd( Zarinpal::verify('OK', 1000, $results['Authority']));
    }

    public function createOrder($totalAmount, $userInfo, $ticketInfo, $payMethod)
    {
        $this->getAuthority($totalAmount);
        //dd($this->authority);
        // dd($this->authority);
        Order::create([
            'authority' => $this->authority,
            'totalAmount' => $totalAmount,
            'userInfo' => $userInfo,
            'ticketInfo' => $ticketInfo,
            'payMethod' => $payMethod,
            'payStatus' => 0,//1=>naghd , 2=>ghesty
            'user_id' => Auth::id(),
        ]);
        $this->zarinpal();
        $verifyZarinpal = Zarinpal::verify('OK', $totalAmount, $this->authority);
    }
}
