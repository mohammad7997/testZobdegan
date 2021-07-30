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
        $parentTickets = Ticket::where([
            'parent'=> 0,
            'type'=>1
            ])->get();
        $OwnTickets = Ticket::leftJoin('installment_features', 'tickets.id', '=', 'installment_features.ticket_id')
        ->where(DB::raw('tickets.type'), '!=', 0)
        ->get();

        $childTickets = Ticket::leftJoin('installment_features', 'tickets.id', '=', 'installment_features.ticket_id')
            ->where(DB::raw('tickets.parent'), '!=', 0)
            ->get();
        return view('client.home', compact(['childTickets', 'parentTickets','OwnTickets']));
    }
}
