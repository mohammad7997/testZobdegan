<?php


namespace App\Repository;


use App\Models\InstallmentPay;
use Zarinpal\Laravel\Facade\Zarinpal;

class PanelRepository
{
    public function getAuthority($amount)
    {
        $results = Zarinpal::request(
            "http://localhost:8000/panel/verifyPay/",          //required
            $amount,                                  //required
            'testing',                             //required
            'me@example.com',                      //optional
            '09000000000'                        //optional
        );

        return $results['Authority'];
    }

    public function zarinpal()
    {
        Zarinpal::redirect(); // redirect user to zarinpal
    }

    public function pay($installment)
    {
        $amount = $installment->installmentPay;
        $Authority = $this->getAuthority($amount);
        $installment->update([
            'authority' => $Authority
        ]);
        $this->zarinpal();
    }

    public function verify($authority)
    {
        $InstallmentPay = InstallmentPay::query()->where('authority', $authority)->first();
        $ticketInfo = unserialize($InstallmentPay->order()->first()->ticketInfo);
        $ticketInfoInstallmentTime = $ticketInfo->InstallmentFeature()->first()->installmentTime;
        $InstallmentFeature = $ticketInfo->InstallmentFeature()->first();

        $ticketInfoInstallmentNum = $InstallmentFeature->installmentTime / $InstallmentFeature->installmentNum;
        //$InstallmentTime = ($ticketInfoInstallmentTime) * 30 * 24 * 60 * 60;
        $time = strtotime('+' . $ticketInfoInstallmentNum . 'month', strtotime($InstallmentPay->timeOfInstallment));
        $nextTimeInstallment = date('Y-m-d', $time);

        InstallmentPay::where('authority', $authority)->update([
            'installmentNum' => $InstallmentPay->installmentNum - 1,
            'timeOfInstallment' => $nextTimeInstallment,
        ]);


        if ($InstallmentPay->installmentNum == 1) {
            $InstallmentPay->order()->update([
                'payStatus' => 1
            ]);
            $InstallmentPay->delete();
        }
    }
}
