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
        $tickets = Ticket::leftJoin('installment_features', 'tickets.id', '=', 'installment_features.ticket_id')
            ->orderBy(DB::raw('tickets.id'),'Desc')
            ->get();
        return view('client.home',compact('tickets'));
    }
}
