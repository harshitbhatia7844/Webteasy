<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
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

        if (Auth::guard('admin')->attempt($credentials) && DB::table('admins')
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

    //------------- Admin Signup/Registration -------------//
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'mobile_no' => 'required',
            'city' => 'required',
            'state' => 'required'
        ]);

        $inserted = DB::table('admins')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'password' => Hash::make($request->password),
            'status' => 0,
            'city' => $request->city,
            'state' => $request->state,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        if ($inserted) {
            return redirect(route('admin.login'))
                ->withSuccess('Your Account have been created successfully!');
        } else {
            return redirect(route('admin.register'));
        }
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
        if (Auth::guard('admin')->check()) {
            $centres = DB::table('centres')->count();
            $branches = DB::table('branches')->count();
            $payments = DB::table('payments')->sum('amount');
            return view('admin.index', ['centres' => $centres, 'branches' => $branches, 'payments' => $payments]);
        }

        return redirect()->route('admin.login')
            ->withErrors('Please login to access the dashboard.');
    }

    //--------------Admin Profile ---------------//
    public function profile()
    {
        if (Auth::guard('admin')->check()) {
            $user = Auth::getUser();
            return view('admin.profile', $user);
        }

        return redirect()->route('admin.login')
            ->withErrors('Please login to access the dashboard.');
    }
};
