<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StudentController extends Controller
{
    //------------- Student Login -------------//
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
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
        $user = Auth::getUser();
        $today = DB::table('attendance')->where('student_id', $user->id)
            ->where('date', date(today()))->count();
        $balance = $user->wallet_balance;
        $batch = DB::table('batches as b')
            ->join('enrollments as e', 'b.batch_id', 'e.batch_id')
            ->where('e.student_id', $user->id)->count();
        $total = DB::table('attendance')->where('student_id', $user->id)->count();
        $present = DB::table('attendance')->where('student_id', $user->id)
            ->where('status', '1')->count();
        $attendance = $present * 100 / ($total?:1);
        $fees = DB::table('enrollments')->where('student_id', $user->id)->sum('amount');
        return view('student.index', [
            'fees' => $fees,
            'batch' => $batch,
            'attendance' => $attendance,
            'balance' => $balance
        ]);
    }

    //------------- Student Profile -------------//
    public function profile()
    {
        if (Auth::guard('student')->check()) {
            $user = Auth::getUser();
            return view('student.profile', $user);
        }

        return redirect()->route('admin.login')
            ->withErrors('Please login to access the dashboard.');
    }

    //------------- Notification -------------//
    public function notification()
    {
        $user = Auth::getUser();
        $general = DB::table('generalnotifications')->where('centre_id', $user->centre_id)->get();
        $batch = DB::table('enrollments')->where('student_id', $user->id)->first();
        $notis = DB::table('notifications')->where('batch_id', $batch?$batch->batch_id:'-1')->get();
        return view('student.notification', [
            'notification' => $notis,
            'general' => $general
        ]);
    }
}
