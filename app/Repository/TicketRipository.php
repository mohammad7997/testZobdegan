<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/27/2021
 * Time: 10:25 AM
 */

namespace App\Repository;


use App\Models\Ticket;
use App\Models\InstallmentFeature;
use Illuminate\Support\Facades\Storage;


class TicketRipository
{

    /**
     * uploader
     * @param $fileImage
     * @return mixed
     */
    public function uploadImage($fileImage)
    {
        $exImage = $fileImage->guessClientExtension();
        $nameImage = time() . '.' . $exImage;
        Storage::disk('public')->putFileAs('', $fileImage, $nameImage);
        $urlImage = Storage::url($nameImage);
        return $urlImage;
    }

    /**
     * get ticket info
     * @return mixed
     */
    public function TicketInfo()
    {
        return Ticket::orderByDesc('id')->where('parent',0)->get();
    }


    public function parentsTicketInfo()
    {
        return Ticket::where([
            'parent' => 0,
            'type' => 1
        ])->get();
    }

    public function childTicketInfo($ticket)
    {
        return Ticket::where('parent', $ticket->id)->orderByDesc('id')->get();
    }

    /**
     * create group ticket
     * @param $request
     * @return bool
     */
    public function createGroupTicket($request)
    {
        try {
            // upload image
            $urlImage = $this->uploadImage($request->file('image'));

            // create ticket
            Ticket::create([
                'title' => $request->input('title'),
                'property' => serialize($request->input('property')),
                'image' => $urlImage,
                'description' => $request->input('description'),
                'type' => $request->input('type'),
                'priceCash' => $request->input('priceCash'),
                'priceInstallment' => $request->input('priceInstallment'),
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


    /**
     * create own ticket
     * @param $request
     * @return bool
     */
    public function createOwnTicket($request)
    {
        try {
            // upload image
            $urlImage = $this->uploadImage($request->file('image'));

            // create ticket
            $ticket = Ticket::create([
                'title' => $request->input('title'),
                'property' => $request->input('property') != null ? serialize($request->input('property')) : null,
                'image' => $urlImage,
                'description' => $request->input('description'),
                'type' => $request->input('type'),
                'priceCash' => $request->input('priceCash'),
                'priceInstallment' => $request->input('priceInstallment'),
                'parent'=>$request->input('parent')!='' ? $request->input('parent') : 0,
            ]);


            $ticket->InstallmentFeature()->create([
                'prepayment' => $request->input('prepayment'),
                'installmentNum' => $request->input('installmentNum'),
                'installmentTime' => $request->input('installmentTime'),
            ]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


    /**
     * create group ticket
     * @param $request
     * @return bool
     */
    public function updateGroupTicket($ticket, $request)
    {

        $urlImage = '';
        try {
            // upload image
            if ($request->file('image') != '') {
                $pathUrl = array_reverse(explode('/', $ticket->image))[0];
                Storage::disk('public')->delete($pathUrl);
                $urlImage = $this->uploadImage($request->file('image'));
            }

            // update ticket
            $ticket->update([
                'title' => $request->input('title'),
                'property' => serialize($request->input('property')),
                'image' => $urlImage != '' ? $urlImage : $ticket->image,
                'description' => $request->input('description'),
                'type' => $request->input('type'),
                'priceCash' => $request->input('priceCash'),
                'priceInstallment' => $request->input('priceInstallment'),
            ]);

            // delete Installment Feature when change type ticket to group
            $InstallmentFeatureCount = $ticket->InstallmentFeature()->count();
            if ($InstallmentFeatureCount > 0) {
                $ticket->InstallmentFeature()->delete();
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


    /**
     * update own ticket
     * @param $ticket
     * @param $request
     * @return bool
     */
    public function updateOwnTicket($ticket, $request)
    {

        try {
            $urlImage = '';
            // upload image
            if ($request->file('image') != '') {
                $pathUrl = array_reverse(explode('/', $ticket->image))[0];
                Storage::disk('public')->delete($pathUrl);
                $urlImage = $this->uploadImage($request->file('image'));
            }

            // update ticket
            $ticket->update([
                'title' => $request->input('title'),
                'property' => $request->input('property') != null ? serialize($request->input('property')) : null,
                'image' => $urlImage != '' ? $urlImage : $ticket->image,
                'description' => $request->input('description'),
                'type' => $request->input('type'),
                'priceCash' => $request->input('priceCash'),
                'priceInstallment' => $request->input('priceInstallment'),
                'parent'=>$request->input('parent')!='' ? $request->input('parent') : 0,
            ]);


            // update Installment Feature for ticket
            $InstallmentFeatureCount = $ticket->InstallmentFeature()->count();
            if ($InstallmentFeatureCount < 1) {
                $ticket->InstallmentFeature()->create([
                    'prepayment' => $request->input('prepayment'),
                    'installmentNum' => $request->input('installmentNum'),
                    'installmentTime' => $request->input('installmentTime'),
                ]);
            } else {
                $ticket->InstallmentFeature()->update([
                    'prepayment' => $request->input('prepayment'),
                    'installmentNum' => $request->input('installmentNum'),
                    'installmentTime' => $request->input('installmentTime'),
                ]);
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


    /**
     * delete ticket
     * @param $ticket
     * @return bool
     */
    public function deleteTicket($ticket)
    {
        try {
            $pathUrl = array_reverse(explode('/', $ticket->image))[0];
            $child=Ticket::where('parent',$ticket->id)->count();
            if ($child < 1) {
                $ticket->delete();
            }//delete own ticket
            else{
                $childTickets=Ticket::where('parent',$ticket->id)->get();
                foreach ($childTickets as $childTicket){
                    Storage::disk('public')->delete($childTicket->image);
                }
                Ticket::where('parent',$ticket->id)->delete();
                $ticket->delete();
            }//delete child ticket of group ticket

            Storage::disk('public')->delete($pathUrl);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}
