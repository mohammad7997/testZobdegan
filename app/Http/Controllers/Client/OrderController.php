<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Ticket;
use App\Repository\OrderRipositpry;
use Illuminate\Http\Request;
use \Illuminate\Contracts\Foundation\Application;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;


class OrderController extends Controller
{

    /**
     * show info order for create an order
     * @param Ticket $ticket
     * @return Application|Factory|View
     */
    public function create(Ticket $ticket)
    {

        $ticket = $ticket->leftJoin('installment_features', 'tickets.id', '=', 'installment_features.ticket_id')
            ->orderBy(DB::raw('tickets.id'), 'Desc')
            ->first();
        return view('client.orderInfo', compact('ticket'));
    }


    /**
     * save an order for users
     * @param Request $request
     * @param Ticket $ticket
     */
    public function store(Request $request, Ticket $ticket)
    {
        $totalAmount = $ticket->payMethod == 0 ? $ticket->priceInstallment : $ticket->priceCash;
        $userInfo = '';
        if ($request->input('name') != '') {
            $request->validate([
                'name' => 'required',
                'family' => 'required',
                'nationalId' => 'required',
                'phone' => 'required',
                'gender' => 'required',
                'address' => 'required',
                'email' => 'required',
            ]);

            $userInfo = serialize([
                'name' => $request->input('name'),
                'family' => $request->input('family'),
                'nationalId' => $request->input('nationalId'),
                'phone' => $request->input('phone'),
                'gender' => $request->input('gender'),
                'address' => $request->input('address'),
                'email' => $request->input('email')
            ]);
        }
        $ticketInfo = serialize($ticket);
        $payMethod = $request->payMethod;
        resolve(OrderRipositpry::class)->createOrder($totalAmount, $userInfo, $ticketInfo, $payMethod, $ticket);
    }

    public function verify(Request $request)
    {
        if ($request->has('Authority')) {
            if ($request->Status == 'OK') {
                $order = resolve(OrderRipositpry::class)->verify($request->Authority);
                return redirect(route('Order.factor', $order));
            } else {
                $msg = 'پرداخت ناموفق ';
                return redirect(route('index'))->with('failed', $msg);
            }
        }
    }

    /**
     * create actor for user after buy
     * @param Order $order
     * @return Factory|View
     */
    public function factor(Order $order)
    {
        $ticketInfo=unserialize($order->ticketInfo);
        if (unserialize($order->userInfo) != '' && unserialize($order->userInfo)->name !=''){
            $userInfo=$order->userInfo;
        }else{
            $userInfo=$order->user()->first();
        }


        if ($order->payStatus == 1){
            $pay=$order->totalAmount;
            $payMethod='نقدی';
        }else{
            $pay=$order->installmentPay()->first()->prepayment;
            $payMethod='اقساطی';
        }

        return view('client.factor', compact(['order','pay','ticketInfo','userInfo','payMethod']));
    }


    /**
     * generate PDF of factor
     * @param Order $order
     * @throws \Mpdf\MpdfException
     */
    public function PDF(Order $order)
    {
        $htmlView=$this->factor($order);

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'orientation' => 'P',
        ]);
        $mpdf->SetDefaultFont('BMitra');
        $mpdf->WriteHTML($htmlView);
        $mpdf->Output();
    }
}
