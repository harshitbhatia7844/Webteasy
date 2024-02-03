<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    //------------- Student Login -------------//
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'roll_no' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('student.dashboard')
                ->withSuccess('You have successfully logged in!');
        }
        return back()->withErrors('Your provided credentials do not match in our records.');
    }

    //------------- Student Logout -------------//
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('student.login')
            ->withSuccess('You have logged out successfully!');
    }

    //------------- Student Dashboard -------------//
    public function dashboard()
    {
        return view('student.index');
    }

    //------------- Student Profile -------------//
    public function profile()
    {
        $user = Auth::getUser();
        return view('student.profile', $user);
    }

    //------------- Student Result -------------//
    public function result()
    {
        return view('student.result');
    }

    //------------- Quiz -------------//
    public function quiz()
    {
        $questions = DB::table('questions')
            ->inRandomOrder()->limit(10)->get();
        return view('student.Quiz', ['questions' => $questions]);
    }

    //------------- student Signup -------------//
    public function signup(Request $request)
    {
        $request->validate([
            'roll_no' => "required",
            "name" => "required",
            'email' => 'required|email',
            'mobile_no' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password',
            'gender' => 'required',
            'dob' => 'required',
        ]);
        if (student::where('email', $request->email)
            ->orWhere('mobile_no', $request->mobile_no)
            ->orWhere('roll_no', $request->roll_no)
            ->first()
        ) {
            return redirect()->route('student.login')
                ->withErrors('User Already Exist. Try to login now!');
        }
        $inserted = DB::table('students')->insert([
            'roll_no' => $request->roll_no,
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'course' => $request->course,
            'branch' => $request->branch,
            'semester' => $request->semester,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        if ($inserted) {
            return redirect(route('student.login'))
                ->withSuccess('Your Account have been created successfully!');
        } else {
            return redirect(route('student.register'))->withErrors('Registration failed');
        }
    }

    //------------- student Reset Password -------------//
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'dob' => 'required',
            'newpassword' => 'required'
        ]);
        if ($user = Student::where('email', $request->email)->first()) {
            if ($request->dob == $user->dob) {
                DB::table('students')->update([
                    'password' => Hash::make($request->newpassword),
                ]);
                return redirect(route('student.login'))
                    ->withSuccess('Your Password have been Updated successfully!');
            }
            return redirect(route('student.forgetpassword'))
                ->withErrors('DOB does not Match.');
        }
        return redirect()->route('student.forgetpassword')
            ->withErrors('User Not Exist.');
    }
}
