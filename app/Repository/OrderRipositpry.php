<?php


namespace App\Repository;

use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Zarinpal\Laravel\Facade\Zarinpal;
use \Illuminate\Database\Eloquent\Builder;
use \Illuminate\Database\Eloquent\Model;

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
        );

        $this->authority = $results['Authority'];
    }

    public function zarinpal()
    {
        Zarinpal::redirect(); // redirect user to zarinpal
    }

    public function createOrder($totalAmount, $userInfo, $ticketInfo, $payMethod,Ticket $ticket)
    {
        $amount = $ticket->payMethod == 0 ? $ticket->InstallmentFeature()->first()->prepayment : $ticket->priceCash;
        $this->getAuthority($amount);
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

    /**
     * verify authority and update order
     * payMethod = 0 => installment
     * payMethod = 1 => cash
     * @param $Authority
     * payStatus = 0 => not pay
     * payStatus = 1 => pay
     * payStatus = 2 => installment pay
     * @return Builder|Model|object|null
     */
    public function verify($Authority)
    {
        $order = Order::query()->where('authority', $Authority)->first();
        if ($order->payMethod == 0) {
            $order->update([
                'payStatus' => 2
            ]);

            $time=strtotime(now());
            $ticketInfo = unserialize($order->ticketInfo);
           //    dd($ticketInfo->InstallmentFeature()->first()->prepayment);
            $InstallmentTime = ($ticketInfo->installmentTime) * 30 * 24 * 60 * 60;
            $nextInstallmentTime=$time+$InstallmentTime;
           // dd(date('Y-m-d',$nextInstallmentTime));
            $nextInstallmentTime = date('Y-m-d', $nextInstallmentTime);

            $InstallmentFeature=$ticketInfo->InstallmentFeature()->first();

            $order->installmentPay()->create([
                'totalAmount' => $order->totalAmount,
                'prepayment' => $InstallmentFeature->prepayment,
                'installmentPay' => $ticketInfo->priceInstallment / $InstallmentFeature->installmentNum,
                'installmentNum' => $InstallmentFeature->installmentNum,
                'timeOfInstallment' => $nextInstallmentTime,
            ]);

        } else {
            $order->update([
                'payStatus' => 1
            ]);
        }
        return $order;
    }
}
