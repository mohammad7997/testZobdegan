<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderAdminController extends Controller
{
    public function order()
    {
        $ordersCash = Order::query()->where([
            'payStatus' => 1,
        ])->get();

        $installments = Order::query()->leftJoin('installment_pays', 'orders.id', '=', 'installment_pays.order_id')
            ->orderBy(DB::raw('orders.id'), 'Desc')
            ->where(DB::raw('orders.payMethod'), 0)
            ->where(DB::raw('orders.payStatus'), 2)
            ->select('orders.*', 'installment_pays.prepayment', 'installment_pays.id as idInstallment', 'installment_pays.timeOfInstallment', 'installment_pays.installmentPay', 'installment_pays.installmentNum')
            ->get();

        return view('admin.orders.orders',compact(['ordersCash','installments']));
    }
}
