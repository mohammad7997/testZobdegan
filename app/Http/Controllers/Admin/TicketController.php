<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Ticket;
use App\Repository\TicketRipository;
use Illuminate\Http\Request;
use \Illuminate\Contracts\Foundation\Application;
use \Illuminate\Http\RedirectResponse;
use \Illuminate\Routing\Redirector;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\View\View;

class TicketController extends Controller
{

    public function index()
    {
        $ticketInfo = resolve(TicketRipository::class)->TicketInfo();
        return view('admin.tickets.tickets', compact('ticketInfo'));
    }


    public function childTicket(Ticket $ticket)
    {
        $childTicketInfo = resolve(TicketRipository::class)->childTicketInfo($ticket);
        return view('admin.tickets.childTickets', compact(['childTicketInfo', 'ticket']));
    }


    public function create()
    {
        return view('admin.tickets.createTicket');
    }

    public function createChildTicket(Ticket $ticket)
    {
        $parentsTicketInfo = resolve(TicketRipository::class)->parentsTicketInfo();
        return view('admin.tickets.createChildTicket', compact(['ticket', 'parentsTicketInfo']));
    }


    /**
     * create ticket
     * own ticket or groupTicket
     * type=0 ==> own
     * type=1 ==> group
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {


        $messag = [
            'title.required' => 'فیلد عنوان خالی است',
            'title.max' => 'حداکثر تعداد کاراکتر مجاز در فیلد عنوان 255 کاراکتر است',
            'title.unique' => 'آگهی با این نام وجود دارد',
            'image.size' => 'حداکثر سایز عکس 4 مگابایت است',
            'image.mimes' => 'فرمت عکس باید jpg یا png باشد ',
            'description.required' => 'فیلد توضیح خالی میباشد ',
            'description.max' => 'حداکثر تعداد کاراکتر مجاز در فیلد توضیح 100000 کاراکتر است ',
            'type.required' => 'نوع آگهی را مشخص کنید',
            'image.required' => 'فیلد عکس خالی شت'
        ];
        $request->validate([
            'title' => 'required| max:255| unique:tickets',
            'image' => 'required | file|mimes:jpg,png',
            'property' => '  max:255',
            'description' => 'required| max:100000',
            'type' => 'required',
        ], $messag);

        // validation for own ticket

        if ($request->type == 0) {
            $messag = [
                'priceCash.required' => 'فیلد قیمت نقدی خالی است',
                'priceCash.max' => 'حداکثر تعداد کاراکتر مجاز در فیلد قیمت نقدی 20 کاراکتر است',
                'priceInstallment.required' => 'فیلد قیمت اقساطی خالی است',
                'priceInstallment.max' => 'حداکثر تعداد کاراکتر مجاز در فیلد قیمت اقساطی 20 کاراکتر است',
                'title.max' => 'حداکثر تعداد کاراکتر مجاز در فیلد عنوان 255 کاراکتر است',
                'installmentNum.required' => 'تعداد اقساط را مشخص کنید',

            ];
            $request->validate([
                'priceCash' => 'required| max:20',
                'priceInstallment' => 'required| max:20',
                'installmentTime' => 'required',
                'installmentNum' => 'required',
                'descriptionTopFactor' => 'required',
                'descriptionBottomFactor' => 'required',
            ], $messag);
        }

        if ($request->type == 0) {
            $response = resolve(TicketRipository::class)->createOwnTicket($request);
            if ($response == true) {
                $message = 'آگهی با موفقیت ثبت شد';
                return redirect(route('Admin.index'))->with('success', $message);
            } else {
                $message = 'آگهی ثبت نشد';
                return redirect(route('Admin.create'))->with('failed', $message);
            }
        } elseif ($request->type == 1) {
            $response = resolve(TicketRipository::class)->createGroupTicket($request);
            if ($response == true) {
                $message = 'آگهی با موفقیت ثبت شد';
                return back()->with('success', $message);
            } else {
                $message = 'آگهی ثبت نشد';
                return back()->with('failed', $message);
            }
        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * @param Ticket $ticket
     * @return Factory|View
     */
    public function edit(Ticket $ticket)
    {
        $InstallmentFeature = [];
        if ($ticket->type == 0) {
            $InstallmentFeature = $ticket->InstallmentFeature()->first();
        }
        return view('admin.tickets.updateTicket', compact('ticket', 'InstallmentFeature'));
    }

    /**
     * @param Ticket $ticket
     * @return Factory|View
     */
    public function editChildTicket(Ticket $ticket)
    {
        $parentsTicketInfo = resolve(TicketRipository::class)->parentsTicketInfo();
        $InstallmentFeature = $ticket->InstallmentFeature()->first();
        return view('admin.tickets.updateChildTicket', compact(['ticket', 'InstallmentFeature','parentsTicketInfo']));
    }


    /**
     * update ticket
     * @param Request $request
     * @param Ticket $ticket
     * @return $this
     */
    public function update(Request $request, Ticket $ticket)
    {

        $messag = [
            'title.required' => 'فیلد عنوان خالی است',
            'title.max' => 'حداکثر تعداد کاراکتر مجاز در فیلد عنوان 255 کاراکتر است',
            'image.size' => 'حداکثر سایز عکس 4 مگابایت است',
            'image.mimes' => 'فرمت عکس باید jpg یا png باشد ',
            'description.required' => 'فیلد توضیح خالی میباشد ',
            'description.max' => 'حداکثر تعداد کاراکتر مجاز در فیلد توضیح 100000 کاراکتر است ',
            'type.required' => 'نوع آگهی را مشخص کنید',
        ];
        $request->validate([
            'title' => 'required| max:255',
            'image' => 'file|mimes:jpg,png',
            'property' => '  max:255',
            'description' => 'required| max:100000',
            'type' => 'required',
        ], $messag);

        // validation for own ticket

        if ($request->type == 0) {
            $messag = [
                'priceCash.required' => 'فیلد قیمت نقدی خالی است',
                'priceCash.max' => 'حداکثر تعداد کاراکتر مجاز در فیلد قیمت نقدی 20 کاراکتر است',
                'priceInstallment.required' => 'فیلد قیمت اقساطی خالی است',
                'priceInstallment.max' => 'حداکثر تعداد کاراکتر مجاز در فیلد قیمت اقساطی 20 کاراکتر است',
                'title.max' => 'حداکثر تعداد کاراکتر مجاز در فیلد عنوان 255 کاراکتر است',
                'installmentNum.required' => 'تعداد اقساط را مشخص کنید',

            ];
            $request->validate([
                'priceCash' => 'required| max:20',
                'priceInstallment' => 'required| max:20',
                'installmentTime' => 'required',
                'installmentNum' => 'required',
            ], $messag);
        }

        if ($request->type == 0) {
            $response = resolve(TicketRipository::class)->updateOwnTicket($ticket, $request);
            if ($response == true) {
                $message = 'آگهی با موفقیت ویرایش شد';
                return back()->with('success', $message);
            } else {
                $message = 'آگهی ویرایش نشد';
                return back()->with('failed', $message);
            }
        } elseif ($request->type == 1) {
            $response = resolve(TicketRipository::class)->updateGroupTicket($ticket, $request);
            if ($response == true) {
                $message = 'آگهی با موفقیت ویرایش شد';
                return back()->with('success', $message);
            } else {
                $message = 'آگهی ویرایش نشد';
                return back()->with('failed', $message);
            }
        }

    }


    /**
     * delete ticket
     * @param Ticket $ticket
     * @return $this
     */
    public function destroy(Ticket $ticket)
    {
        $response = resolve(TicketRipository::class)->deleteTicket($ticket);
        if ($response == true) {
            $message = 'آگهی با موفقیت حذف شد';
            return back()->with('success', $message);
        } else {
            $message = 'آگهی حذف نشد';
            return back()->with('failed', $message);
        }
    }
}
