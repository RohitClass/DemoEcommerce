<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function loginSubmit(Request $request)
    {

        $validator = validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

                $auth = Auth::guard('admin')->user();

                if ($auth->role == 1) {

                    return redirect()->route('dashboard')->with('success', 'Welcome To Dashboard');
                } else {
                    Auth::guard("admin")->logout();
                    return redirect()->route('admin.login')->with('error', 'You are not Authorised to assecc the admin panel');
                }
            } else {
                return redirect()->route('admin.login')->with('error', 'Email! and password! does not match');
            }
        } else {
            return redirect()->route("admin.login")
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }

    public function logout(){

        Auth::guard("admin")->logout();
        return redirect('/admin')->with('error', 'Logout succefully');

    }

}
