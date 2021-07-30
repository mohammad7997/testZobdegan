<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Repository\OrderRipositpry;
use Illuminate\Http\Request;
use \Illuminate\Contracts\Foundation\Application;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
     * save an order for user
     * @param Request $request
     * @param Ticket $ticket
     */
    public function store(Request $request, Ticket $ticket)
    {
        $totalAmount = $ticket->payMethod == 0 ? $ticket->priceInstallment : $ticket->priceCash;
        $userInfo = serialize([
            'name' => $request->input('name'),
            'family' => $request->input('family'),
            'nationalId' => $request->input('nationalId'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'address' => $request->input('address'),
            'email' => $request->input('email')
        ]);
        $ticketInfo = serialize($ticket);
        $payMethod=$request->payMethod;
        resolve(OrderRipositpry::class)->createOrder($totalAmount, $userInfo, $ticketInfo, $payMethod,$ticket);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
