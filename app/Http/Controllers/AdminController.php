<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
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
                $inserted = DB::table('admins')->where('id', Auth::getUser()->id)->update([
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
        $students = DB::table('students')->count();
        $tests = DB::table('tests')->count();
        $feedbacks = DB::table('feedbacks')->count();
        $results = DB::table('results')->count();
        $passed = DB::table('results')
            ->whereRaw('total_score > total_questions/3')->count();
        $failed = DB::table('results')
            ->whereRaw('total_score <= total_questions/3')->count();
        return view('admin.index', [
            'students' => $students,
            'tests' => $tests,
            'feedbacks' => $feedbacks,
            'results' => $results,
            'failed' => round($failed*100/$results, 2),
            'passed' => round($passed*100/$results, 2)
        ]);
    }

    //--------------Admin Profile ---------------//
    public function profile()
    {
        $user = Auth::getUser();
        return view('admin.profile', $user);
    }

    //--------------Admin feedback ---------------//
    public function viewfeedbacks(Request $request)
    {
        $tests = DB::table('tests')->orderByDesc('date')->orderByDesc('start_time')->get();
        if ($request->test_id) {
            $items = DB::table('feedbacks as f')->where('test_id', $request->test_id)
                ->join('students as s', 'f.student_id', 's.roll_no')
                ->orderBy('rating')
                ->paginate(50)->appends([
                    'test_id' => $request->test_id,
                ]);
            $count = $items->firstItem();
            return view('admin.viewfeedback', ['count' => $count, 'items' => $items, 'test_id' => $request->test_id, 'tests' => $tests]);
        }
        $items = DB::table('feedbacks as f')
            ->join('students as s', 'f.student_id', 's.roll_no')
            ->orderBy('rating')
            ->paginate(50);
        $count = $items->firstItem();
        return view('admin.viewfeedback', ['count' => $count, 'items' => $items, 'tests' => $tests]);
    }

    //------------- Admin View All Students -------------//
    public function viewstudent(Request $request)
    {
        if ($request->course || $request->branch || $request->semester) {
            $students = DB::table('students')
                ->where('course', 'like', '%' . $request->course . '%')
                ->where('branch', 'like', '%' . $request->branch . '%')
                ->where('semester', 'like', '%' . $request->semester . '%')
                ->paginate(50)->appends([
                    'course' => $request->course,
                    'branch' => $request->branch,
                    'semester' => $request->semester
                ]);
            $count = $students->firstItem();
            return view('admin.viewstudents', ['count' => $count, 'items' => $students, 'course' => $request->course, 'branch' => $request->branch, 'semester' => $request->semester]);
        }
        $students = DB::table('students')->paginate(50);
        $count = $students->firstItem();
        return view('admin.viewstudents', ['count' => $count, 'items' => $students]);
    }

    //------------- Admin update Student Profile -------------//
    public function updatestudent(Request $request)
    {
        DB::table('students')->where('id', $request->id)->update([
            'roll_no' => $request->roll_no,
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'gender' => $request->gender,
            'course' => $request->course1,
            'branch' => $request->branch1,
            'semester' => $request->semester1,
            'updated_at' => now()
        ]);
        return back()->withSuccess("Profile has been updated Successfully!");
    }

    //------------- Admin update question -------------//
    public function updatequestion(Request $request)
    {
        DB::table('questions')->where('id', $request->id)->update([
            'question' => $request->question,
            'a' => $request->a,
            'b' => $request->b,
            'c' => $request->c,
            'd' => $request->d,
            'answer' => $request->answer,
        ]);
        return back()->withSuccess("Question updated Successfully!");
    }

    //------------- Admin View All Students -------------//
    public function viewresults(Request $request)
    {
        $tests = DB::table('tests')->orderByDesc('date')->orderByDesc('start_time')->get();
        if ($request->test_id) {
            $students = DB::table('results as r')->where('test_id', $request->test_id)
                ->join('students as s', 'r.student_roll_no', 's.roll_no')
                ->orderByDesc('total_score')
                ->paginate(50)->appends([
                    'test_id' => $request->test_id,
                ]);
            $count = $students->firstItem();
            return view('admin.viewresults', ['count' => $count, 'items' => $students, 'test_id' => $request->test_id, 'tests' => $tests]);
        }
        $students = DB::table('results as r')
            ->join('students as s', 'r.student_roll_no', 's.roll_no')
            ->orderByDesc('total_score')
            ->where('id', -1)
            ->paginate(50);
        $count = $students->firstItem();
        return view('admin.viewresults', ['count' => $count, 'items' => $students, 'tests' => $tests]);
    }

    //--------------Admin Profile ---------------//
    public function viewtest()
    {
        $tests = DB::table('tests')
            ->orderByDesc('date')
            ->orderByDesc('start_time')
            ->get();
        return view('admin.viewtest', ['tests' => $tests]);
    }

    //--------------Admin Profile ---------------//
    public function viewquestions(Request $request)
    {
        $tests = DB::table('tests')->orderByDesc('date')->orderByDesc('start_time')->get();
        if ($request->test_id) {
            $items = DB::table('tqs')
                ->join('questions as q', 'tqs.tqs_question_id', 'q.id')
                ->where('tqs_test_id', $request->test_id)->paginate(50)->appends([
                    'test_id' => $request->test_id,
                ]);
            $count = $items->firstItem();
            return view('admin.viewquestions', ['count' => $count, 'items' => $items, 'test_id' => $request->test_id, 'tests' => $tests]);
        }
        $items = DB::table('questions')->paginate(50);
        $count = $items->firstItem();
        return view('admin.viewquestions', ['count' => $count, 'items' => $items, 'tests' => $tests]);
    }

    //--------------Admin Profile ---------------//
    public function addtest(Request $request)
    {
        $total = DB::table('tests')->orderByDesc('test_id')->first();
        if ($request->file('file')) {
            $file = $request->file('file');
            $fileContents = file($file->getPathname());
            $count = 0;
            $q = DB::table('questions')->orderByDesc('id')->first();
            foreach ($fileContents as $line) {
                $count++;
                $data = str_getcsv($line);

                DB::table('questions')->insert([
                    'question' => $data[0],
                    'a' => $data[1],
                    'b' => $data[2],
                    'c' => $data[3],
                    'd' => $data[4],
                    'answer' => $data[5],
                ]);
            }
            for ($i = $q->id + 1; $i <= $q->id + $count; $i++) {
                DB::table('tqs')->insert([
                    'tqs_test_id' => $total->test_id + 1,
                    'tqs_question_id' => $i
                ]);
            }
        }
        DB::table('tests')->insert([
            'test_id' => $total->test_id + 1,
            'name' => $request->name,
            'duration' => $request->duration,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'no_of_questions' => $request->no_of_questions,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect(route('admin.createtest'))
            ->withSuccess('Test has been created successfully!');
    }

    //--------------Admin addtq ---------------//
    public function addtq(Request $request)
    {
        $tests = DB::table('tests')->orderByDesc('date')->get();
        $items = DB::table('questions')->paginate(25);
        $count = $items->firstItem();
        return view('admin.addtq', ['count' => $count, 'items' => $items, 'tests' => $tests]);
    }

    //--------------Admin addtq ---------------//
    public function addquestions()
    {
        $tests = DB::table('tests')->orderByDesc('date')->limit(5)->get();
        return view('admin.addquestions', ['tests' => $tests]);
    }

    //--------------Admin analytics ---------------//
    public function analytics(Request $request)
    {
        $items = DB::table('q_attempts as a')
            ->join('questions as q', 'a.question_id', 'q.id')
            ->where('test_id', $request->test_id)
            ->where('student_id', $request->student_id)->get();
        return view('admin.analytics', ['items' => $items]);
    }

    //--------------Admin Profile ---------------//
    public function savetq(Request $request)
    {
        $qids = $request->qid;
        if (!empty($qids)) {
            foreach ($qids as $qid) {
                if (DB::table('tqs')
                    ->where('tqs_test_id', $request->tid,)
                    ->where('tqs_question_id', $qid,)->exists()
                ) {
                    continue;
                }
                DB::table('tqs')->insert([
                    'tqs_test_id' => $request->tid,
                    'tqs_question_id' => $qid,
                ]);
            }
            return redirect(route('admin.addtq'))
                ->withSuccess('Questions uploaded successfully!');
        }
        return redirect()->back()
            ->withErrors(['No questions selected']);
    }

    //--------------Admin Profile ---------------//
    public function savequestions(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        $count = 0;
        foreach ($fileContents as $line) {
            $count++;
            $data = str_getcsv($line);

            DB::table('questions')->insert([
                'question' => $data[0],
                'a' => $data[1],
                'b' => $data[2],
                'c' => $data[3],
                'd' => $data[4],
                'answer' => $data[5],
            ]);
        }
        $q = DB::table('questions')->orderByDesc('id')->first();
        if ($request->test_id) {
            for ($i = $q->id - $count + 1; $i <= $q->id; $i++) {
                DB::table('tqs')->insert([
                    'tqs_test_id' => $request->test_id,
                    'tqs_question_id' => $i
                ]);
            }
        }
        return redirect(route('admin.addquestions'))
            ->withSuccess('Questions uploaded successfully!');
    }

    public function downloadPDF(Request $request)
    {
        ($request->test_id)
            ? $users = DB::table('results as r')->where('test_id', $request->test_id)
            ->join('students as s', 'r.student_roll_no', 's.roll_no')
            ->orderByDesc('total_score')
            ->get()
            : $users = DB::table('results as r')
            ->join('students as s', 'r.student_roll_no', 's.roll_no')
            ->orderByDesc('total_score')
            ->get();
        $tests = ($request->test_id)
            ? DB::table('tests')->where('test_id', $request->test_id)->first()
            :  NULL;
        $pdf = FacadePDF::loadView('admin.usersdetails', array('items' =>  $users, 'tests' => $tests))
            ->setPaper('a4', 'portrait');

        return $pdf->download('students-result' . now() . '.pdf');
    }
};
