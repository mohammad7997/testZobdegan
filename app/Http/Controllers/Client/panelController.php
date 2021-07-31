<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\InstallmentPay;
use App\Models\Order;
use App\Models\Ticket;
use App\Repository\OrderRipositpry;
use App\Repository\PanelRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class panelController extends Controller
{
    public function index()
    {
        $ordersCash = Order::query()->where([
            'payStatus' => 1,
            'user_id'=>Auth::id()
        ])->get();

        $installments=Order::query()->leftJoin('installment_pays', 'orders.id', '=', 'installment_pays.order_id')
            ->orderBy(DB::raw('orders.id'), 'Desc')
            ->where(DB::raw('orders.user_id'), Auth::id())
            ->where(DB::raw('orders.payMethod'), 0)
            ->where(DB::raw('orders.payStatus'), 2)
            ->select('orders.*', 'installment_pays.prepayment', 'installment_pays.id as idInstallment', 'installment_pays.timeOfInstallment', 'installment_pays.installmentPay', 'installment_pays.installmentNum')
            ->get();

        return view('client.panel',compact(['ordersCash','installments']));
    }

    public function payInstallment(InstallmentPay $installmentPay)
    {
        resolve(PanelRepository::class)->pay($installmentPay);
    }

    public function verifyPay(Request $request)
    {
        if ($request->has('Authority')) {
            if ($request->Status == 'OK') {
                //dd($request->Authority);
                resolve(PanelRepository::class)->verify($request->Authority);
                $msg = 'پرداخت موفق ';
                return redirect(route('Panel.index'))->with('success', $msg);
            } else {
                $msg = 'پرداخت ناموفق ';
                return redirect(route('Panel.index'))->with('failed', $msg);
            }
        }

    }
}
