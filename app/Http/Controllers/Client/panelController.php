<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class panelController extends Controller
{
    public function index()
    {
        $ordersCash = Order::query()->where([
            'payMethod' => 1,
            'payStatus' => 1
        ])->get();




        $installments=Order::query()->leftJoin('installment_pays', 'orders.id', '=', 'installment_pays.order_id')
            ->orderBy(DB::raw('orders.id'), 'Desc')
            ->where(DB::raw('orders.user_id'), Auth::id())
            ->where(DB::raw('orders.payMethod'), 0)
            ->where(DB::raw('orders.payStatus'), 2)
            ->select('orders.*', 'installment_pays.prepayment', 'installment_pays.timeOfInstallment', 'installment_pays.installmentPay', 'installment_pays.installmentNum')
            ->get();

 //       dd($installment);

        return view('client.panel',compact(['ordersCash','installments']));
    }
}
