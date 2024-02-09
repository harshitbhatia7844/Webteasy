<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
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

    //------------- Admin View All Students -------------//
    public function viewstudent(Request $request)
    {
        if ($request->course && $request->branch && $request->semester) {
            $students = DB::table('students')
                ->where('course', $request->course)
                ->where('branch', $request->branch)
                ->where('semester', $request->semester)
                ->paginate(10);
            return view('admin.viewstudents', ['items' => $students]);
        }
        $students = DB::table('students')->paginate(10);
        return view('admin.viewstudents', ['items' => $students]);
    }

    //------------- Admin View All Students -------------//
    public function viewresults(Request $request)
    {
        if ($request->test_id) {
            $students = DB::table('results as r')->where('test_id', $request->test_id)
                ->join('students as s', 'r.student_roll_no', 's.roll_no')
                ->orderByDesc('total_score')
                ->paginate(10);
            return view('admin.viewresults', ['items' => $students, 'test_id'=>$request->test_id]);
        }
        $students = DB::table('results as r')
            ->join('students as s', 'r.student_roll_no', 's.roll_no')
            ->orderByDesc('total_score')
            ->paginate(10);
        return view('admin.viewresults', ['items' => $students, 'test_id' => '']);
    }

    //--------------Admin Profile ---------------//
    public function viewtest()
    {
        $tests = DB::table('tests')
            ->orderByDesc('date')
            ->get();
        return view('admin.viewtest', ['tests' => $tests]);
    }

    //--------------Admin Profile ---------------//
    public function viewquestions()
    {
        $items = DB::table('questions')->paginate();
        return view('admin.viewquestions', ['items' => $items]);
    }

    //--------------Admin Profile ---------------//
    public function addtest(Request $request)
    {
        $total = DB::table('tests')->count();
        DB::table('tests')->insert([
            'test_id' => $total + 1,
            'name' => $request->name,
            'duration' => $request->duration,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
        return redirect(route('admin.createtest'))
            ->withSuccess('Test has been created successfully!');
    }

    public function downloadPDF(Request $request)
    {
        ($request->test_id)
        ?$users = DB::table('results as r')->where('test_id', $request->test_id)
            ->join('students as s', 'r.student_roll_no', 's.roll_no')
            ->orderByDesc('total_score')
            ->get()
        :$users = DB::table('results as r')
            ->join('students as s', 'r.student_roll_no', 's.roll_no')
            ->orderByDesc('total_score')
            ->get();
        $pdf = FacadePDF::loadView('admin.usersdetails', array('items' =>  $users))
            ->setPaper('a4', 'portrait');

        return $pdf->download('students-result'.now().'.pdf');
    }
};
