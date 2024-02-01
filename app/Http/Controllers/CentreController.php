<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class CentreController extends Controller
{
    //------------- Centre Login -------------//
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('centre')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('centre.dashboard')
                ->withSuccess('You have successfully logged in!');
        }
        return back()->withErrors('Your provided credentials do not match in our records.');
    }

    //------------- Centre Logout -------------//
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('centre.login')
            ->withSuccess('You have logged out successfully!');
    }

    //------------- Centre Signup -------------//
    public function signup(Request $request)
    {
        $request->validate([
            "name" => "required",
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password',
            'city' => 'required',
            'state' => 'required'
        ]);
        if (centre::where('email', $request->email)->first()) {
            return redirect()->route('centre.register')
                ->withErrors('User Already Exist.');
        }
        $inserted = DB::table('centres')->insert([
            'centre_id' => $request->centre_id,
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'contact_person' => $request->contact_person,
            'contact_email' => $request->contact_email,
            'contact_no' => $request->contact_no,
            'city' => $request->city,
            'state' => $request->state,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        if ($inserted) {
            return redirect(route('centre.login'))
                ->withSuccess('Your Account have been created successfully!');
        } else {
            return redirect(route('centre.register'));
        }
    }

    //------------- Centre Reset Password -------------//
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'oldpassword' => 'required',
            'newpassword' => 'required'
        ]);
        if ($user = centre::where('email', $request->email)->first()) {
            if (Hash::check($request->oldpassword, $user->password)) {
                $inserted = DB::table('centres')->update([
                    'password' => Hash::make($request->newpassword),
                ]);
                if ($inserted) {
                    return redirect(route('centre.login'))
                        ->withSuccess('Your Password have been Updated successfully!');
                }
                return redirect(route('centre.forgotpassword'))
                    ->withErrors('Failed to update Password.');
            }
            return redirect(route('centre.forgotpassword'))
                ->withErrors('Password does not Match.');
        }

        return redirect()->route('centre.forgotpassword')
            ->withErrors('User Not Exist.');
    }

    //------------- Centre Dashboard -------------//
    public function dashboard()
    {
        if (Auth::guard('centre')->check()) {
            $user = Auth::getUser();
            return view('centres.index');
        }
        return redirect()->route('centre.login')
            ->withErrors('Please login to access the dashboard.');
    }

    //------------- Centre Profile -------------//
    public function profile()
    {
        if (Auth::guard('centre')->check()) {
            $user = Auth::getUser();
            return view('centres.profile', $user);
        }

        return redirect()->route('centre.login')
            ->withErrors('Please login to access the dashboard.');
    }

    //------------- Centre View All Students -------------//
    public function viewstudent()
    {
        $user = Auth::getUser();
        $students = DB::table('students')->paginate(10);
        return view('centres.viewstudents', ['items' => $students]);
    }
}
