<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //------------- Admin Login -------------//
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (
            Auth::guard('admin')->attempt($credentials) && DB::table('admins')
            ->where('email', $request->email)
            ->value('status')    // check status of Admin
        ) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors('Your provided credentials do not match in our records.');
    }

    //------------- Admin Logout -------------//
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')
            ->withSuccess('You have logged out successfully!');
    }

    //------------- Admin Reset Password -------------//
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'oldpassword' => 'required',
            'newpassword' => 'required'
        ]);
        if ($user = Admin::where('email', $request->email)->first()) {
            if (Hash::check($request->oldpassword, $user->password)) {
                $inserted = DB::table('admins')->update([
                    'password' => Hash::make($request->newpassword),
                ]);
                if ($inserted) {
                    return redirect(route('admin.login'))
                        ->withSuccess('Your Password have been Updated successfully!');
                }
                return redirect(route('admin.forgotpassword'))
                    ->withErrors('Failed to update Password.');
            }
            return redirect(route('admin.forgotpassword'))
                ->withErrors('Password does not Match.');
        }

        return redirect()->route('admin.forgotpassword')
            ->withErrors('User Not Exist.');
    }

    //--------------Admin Dashboard ---------------//
    public function dashboard()
    {
        return view('admin.index');
    }

    //--------------Admin Profile ---------------//
    public function profile()
    {
        $user = Auth::getUser();
        return view('admin.profile', $user);
    }
};
