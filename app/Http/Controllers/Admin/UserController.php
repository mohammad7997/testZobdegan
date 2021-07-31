<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function userStatus(User $user)
    {
        $userStatus = $user->status;
        try {


            $user->update([
                'status' => $userStatus == 1 ? 0 : 1
            ]);
            $msg = 'وضعیت کاربر تغییر کرد';
            return redirect(route('Admin.user'))->with('success',$msg);
        }catch (\Exception $e){

            $msg = 'وضعیت کاربر تغییر نکرد';
            return redirect(route('Admin.user'))->with('failed',$msg);
        }
    }
}
