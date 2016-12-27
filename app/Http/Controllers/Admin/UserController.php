<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\Http\Models\AdminUser;

class UserController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function login_result(Request $request)
    {
        $input = $request->all();
        $user = AdminUser::where(['uname' => $input['uname'], 'upass' => md5($input['upass'])])->get();
        if(count($user) > 0)
        {
            Session::put('utoken', $user[0]->utoken);
            return redirect()->route('main');
        }
        return redirect()->route('login');
    }

    public function chpass()
    {
        return view('admin.chpass');
    }

    public function chpass_result(Request $request)
    {
        $input = $request->all();
        if(!empty($input['upass']) && !empty($input['unpass']) && !empty($input['urnpass']) && $input['unpass'] == $input['urnpass'])
        {
            if(AdminUser::where(array('upass' => md5($input['upass']), 'utoken' => Session::get('utoken')))->update(array('upass' => md5($input['unpass']))))
            {
                return "Saved.";
            }
        }
        return "Error!";
    }

    public function logout()
    {
        Session::forget('utoken');
        return redirect()->route('login');
    }

    public function main()
    {
        return view('admin.main');
    }
}
