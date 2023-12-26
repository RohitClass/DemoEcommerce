<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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

    public function logout()
    {

        Auth::guard("admin")->logout();
        return redirect('/admin')->with('error', 'Logout succefully');
    }

    // ---------forgrt password----------

    public function forgetPassword()
    {
        return view('admin.forgetPassword');
    }

    public function forgetSubmit(Request $request)
    {

        $validator = validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->passes()) {

            $user = $user = User::where([
                'email' => $request->email,
                'role' => '1',
            ])->first();

            if ($user) {

                session(['email' => $request->email]);
                return response()->json([
                    'status' => true,
                ]);

            } else {
                return response()->json([
                    'status' => false,
                    'message_notmatch' => 'Email does not match !!'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }
    }
    public function updatePassword(Request $request)
    {
        $email = session('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found with the specified email',
            ]);
        }

        $password = bcrypt($request->password);
        $update = $user->update(['password' => $password]);

        if ($update) {

            session()->flash('success', 'Password updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Password updated successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Password not updated',
            ]);
        }
    }

}
