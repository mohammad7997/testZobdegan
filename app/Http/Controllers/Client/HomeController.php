<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index()
    {
        $tickets = Ticket::query()->leftJoin('installment_features', 'tickets.id', '=', 'installment_features.ticket_id')
            ->orderBy(DB::raw('tickets.id'),'Desc')
            ->select('tickets.*', 'installment_features.installmentNum', 'installment_features.installmentTime','installment_features.prepayment')
            ->get();
        return view('client.home',compact('tickets'));
    }
}
