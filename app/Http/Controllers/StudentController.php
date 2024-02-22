<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Carbon\Carbon;
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
            'email' => 'required',
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
        $tests = DB::table('results')
            ->where('student_roll_no', Auth::getUser()->roll_no)->get();
        $test_count = $tests->count();
        $passed = DB::table('results')
            ->where('student_roll_no', Auth::getUser()->roll_no)
            ->whereRaw('total_score > total_questions/3')->count();
        $count = 0;
        foreach ($tests as $test) {
            $top3 = DB::table('results')
                ->where('test_id', $test->test_id)->orderByDesc('total_score')->limit(3)->get();
            foreach ($top3 as $top) {
                if ($top->student_roll_no == Auth::getUser()->roll_no) {
                    $count += 1;
                }
            }
        }
        return view('student.index', compact('test_count', 'passed', 'count'));
    }

    //------------- Student Profile -------------//
    public function profile()
    {
        $user = Auth::getUser();
        return view('student.profile', $user);
    }

    //------------- Student Profile -------------//
    public function updateprofile(Request $request)
    {
        DB::table('students')->where('roll_no', Auth::getUser()->roll_no)->update([
            'roll_no' => $request->roll_no,
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'gender' => $request->gender,
            'course' => $request->course,
            'branch' => $request->branch,
            'semester' => $request->semester,
            'updated_at' => now()
        ]);
        return back()->withSuccess("Profile has been updated Successfully!");
    }

    //------------- Student instructions -------------//
    public function select(Request $request)
    {
        if (DB::table('results')
            ->where('test_id', $request->test_id)
            ->where('student_roll_no', Auth::getUser()->roll_no)->exists()
        ) {
            return back()->withErrors(["Test Already Submited"]);
        }
        $test = DB::table('tests')->where('test_id', $request->test_id)->first();
        if (now()->gt(Carbon::parse($test->end_time))) {
            return back()->withErrors(["Test Has Expired"]);
        }
        $a = Carbon::parse($test->start_time)->getTimestampMs();
        return view('student.select', ['test' => $test, 'a' => $a]);
    }

    //------------- Student feedback -------------//
    public function feedback(Request $request)
    {
        return view('student.feedback', ['test_id' => $request->test_id]);
    }

    //------------- Student feedback -------------//
    public function viewresult()
    {
        $user = Auth::getUser();
        $data = DB::table('results')
            ->join('tests', 'results.test_id', '=', 'tests.test_id')
            ->where('student_roll_no', $user->roll_no)
            ->paginate(10);
        return view('student.viewresults', ['items' => $data]);
    }

    //------------- Student savefeedback -------------//
    public function savefeedback(Request $request)
    {
        DB::table('feedbacks')->insert([
            'student_id' => Auth::user()->roll_no,
            'test_id' => $request->test_id,
            'rating' => $request->rating,
            'satisfy' => $request->satisfy,
            'level' => $request->level,
            'suggestions' => $request->suggestions
        ]);
        return redirect()->route('student.dashboard')
            ->withSuccess('Feedback Submitted successfully!');
    }

    //--------------student analytics ---------------//
    public function analytics(Request $request)
    {
        $user = Auth::getUser();
        $items = DB::table('results')
            ->where('test_id', $request->test_id)
            ->where('student_roll_no', $user->roll_no)->first();
        $average = DB::table('results')
            ->where('test_id', $request->test_id)->average('total_score');
        return view('student.analytics', compact('items', 'average'));
    }

    //------------- Student view all tests -------------//
    public function viewtests(Request $request)
    {
        $currentTime = now();
        $currentDate = date(now()); // Get the current date

        $activeTests = DB::table('tests')
            ->where('date', '<=', $currentDate)
            ->orderByDesc('date')->orderByDesc('start_time')->orderByDesc('end_time')
            ->limit(5)->get();
        return view('student.viewtests', compact('activeTests'));
    }

    //------------- Student Result -------------//
    public function result(Request $request)
    {
        $user = Auth::getUser();
        $result = DB::table('results')
            ->where('student_roll_no', '=', $user->roll_no)
            ->where('test_id', '=', $request->test_id)
            ->first();
        if (!$result) {
            $atemted = 0;
            $correct = 0;
            $wrong = 0;
            $i = 1;
            $j = 1;
            $total = $request->count;
            while ($j <= $total) {
                $qid = $request->input('ques' . $i);
                $ans = $request->input('option' . $i++);
                $answer = DB::table('questions')->where('id', $qid)->value('answer');
                DB::table('q_attempts')->insert([
                    "student_id" => $user->roll_no,
                    'test_id' => $request->test_id,
                    "question_id" => $qid,
                    's_answer' => $ans
                ]);
                if ($ans) {
                    $atemted++;
                    if ($ans == $answer) {
                        $correct++;
                    } else if ($ans != $answer) {
                        $wrong++;
                    }
                }
                $j++;
            }
            $score = $correct * 1 - $wrong * 0.25;
            DB::table('results')->insert([
                "student_roll_no" => $user->roll_no,
                'test_id' => $request->test_id,
                'total_questions' => $total,
                'attemted' =>  $atemted,
                'correct' => $correct,
                'wrong' =>  $wrong,
                'total_score' =>  $score,
                'created_at' => $request->start_time,
                'updated_at' => now(),
            ]);
            $result = DB::table('results')
                ->where('student_roll_no', '=', $user->roll_no)
                ->where('test_id', '=', $request->test_id)
                ->first();
            $total = DB::table('results')
                ->where('test_id', '=', $request->test_id)->count();
            $time_taken = strtotime($result->updated_at) - strtotime($result->created_at);
            return view('student.result', [
                'r' => $result,
                's' => 1,
                'total' => $total,
                'time_taken' => round($time_taken / 60, 0) .' min ' .$time_taken % 60 . ' sec',
                'test_id' => $request->test_id
            ]);
        }
        $total = DB::table('results')
            ->where('test_id', '=', $request->test_id)->count();
        $time_taken = strtotime($result->updated_at) - strtotime($result->created_at);
        return view('student.result', [
            'r' => $result,
            's' => 0,
            'total' => $total,
            'time_taken' => round($time_taken / 60, 0) .' min ' .$time_taken % 60 . ' sec',
            'test_id' => $request->test_id
        ]);
    }

    //------------- Quiz -------------//
    public function quiz(Request $request)
    {
        if (DB::table('results')->where('test_id', $request->test_id)->where('student_roll_no', Auth::getUser()->roll_no)->exists()) {
            return back()->withErrors(["Test Already Submited"]);
        }
        $test = DB::table('tests')->where('test_id', $request->test_id)->first();
        if (now()->gte(Carbon::parse($test->start_time)) && now()->lt(Carbon::parse($test->end_time))) {
            $questions = DB::table('questions as q')
                ->join('tqs', 'q.id', 'tqs.tqs_question_id')
                ->where('tqs_test_id', $request->test_id)
                ->inRandomOrder()
                ->limit($test->no_of_questions)->get();
            $a = Carbon::parse($test->end_time)->getTimestampMs();
            $now = now();
            return view('student.Quiz', ['questions' => $questions,  'test' => $test, 'a' => $a, 'now' => $now]);
        }
        return  redirect(route('student.select', ['test_id' => $request->test_id]));
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
            'updated_at' => now(),
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
                DB::table('students')->where('email', $request->email)->update([
                    'password' => Hash::make($request->newpassword),
                    'updated_at' => now()
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
