<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Extras;
use App\Models\Student;
use App\Mail\MailNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    //
    public function getTable(Request $request)
    {
        $filter = $request->input();

        $where = array();
        if ($filter['student']) $where[] = array('student_id', '=', $filter['student']);
        $data['result'] = DB::table('students')->where($where)->paginate(12);
        foreach ($data['result'] as $key => $value) {
            $data['result'][$key]->campus = DB::table('campuses')->where('code', $value->campus)->value('description');
        }
        return view('user/student_list', $data);
    }

    public function getModal(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        $data['uid'] = $formFields['uid'];

        $data['campuses_select'] = DB::table('campuses')->get();
        $data['sections_select'] = DB::table('sections')->get();
        $data['yearlevels_select'] = DB::table('yearlevels')->get();
        $data['courses_select'] = DB::table('courses')->get();
        $data['users_select'] = DB::table('users')->where("user_type", "Professor")->get();

        // dd($data);
        return view('user/student_modal', $data);
    }

    public function profileTab(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        $data['uid'] = $formFields['uid'];

        $data['readAccess'] = explode(",", Extras::getAccessList("read", Auth::user()->username));
        // dd($data);   
        return view('user/student_tab', $data);
    }

    public function profile(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        $data['uid'] = $formFields['uid'];

        $data['record'] = DB::table('students')->where("student_id", $data['uid'])->get();
        $data = json_decode($data['record'], true)[0];
        $data['campus_select'] = DB::table('campuses')->get();

        $data['readAccess'] = explode(",", Extras::getAccessList("read", Auth::user()->username));
        $data['editAccess'] = explode(",", Extras::getAccessList("edit", Auth::user()->username));

        return view('user/student_profile', $data);
    }

    public function record(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        $data['uid'] = $formFields['uid'];

        $data['record'] = DB::table('students')->where("student_id", $data['uid'])->get();
        $data = json_decode($data['record'], true)[0];
        $data['country_select'] = DB::table('countries')->get();

        $data['editAccess'] = explode(",", Extras::getAccessList("edit", Auth::user()->username));

        return view('user/student_record', $data);
    }

    public function document(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        $data['uid'] = $formFields['uid'];

        $data['record'] = DB::table('students')->where("student_id", $data['uid'])->get();
        $data = json_decode($data['record'], true)[0];

        $data['editAccess'] = explode(",", Extras::getAccessList("edit", Auth::user()->username));

        return view('user/student_document', $data);
    }

    public function oec(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        $data['uid'] = $formFields['uid'];

        $data['record'] = DB::table('students')->where("student_id", $data['uid'])->get();
        $data = json_decode($data['record'], true)[0];

        $data['readAccess'] = explode(",", Extras::getAccessList("read", Auth::user()->username));
        $data['editAccess'] = explode(",", Extras::getAccessList("edit", Auth::user()->username));

        return view('user/student_oec', $data);
    }

    public function store(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');
        // dd($request->input());
        $formFields = $request->validate([
            'student_id' => ['required'],
            'fname' => ['required'],
            'lname' => ['required'],
            'mname' => ['required'],
            'contact' => ['required'],
            'email' => ['required'],
            'campus' => ['required'],
            'courses' => ['required'],
            'year_level' => ['required'],
            'section' => ['required'],
        ]);

        $formFields['password'] = bcrypt($formFields['student_id']);
        $fullname = $formFields['fname']." ". $formFields['lname'];
        $dataSMS = array(
            'username' => "test",
            'password' => "82dTG0E*",
            'port' => 2,
            'recipients' => $formFields['contact'],
            'sms' => "Hello ". $fullname."! You're successfully been registered your username is your registered email and your password is your student id."
        );

        $reponse = Extras::sendRequest("http://122.54.191.90:8085/goip_send_sms.html", "get", $dataSMS);

        Student::create($formFields);
        $return = array('status' => 1, 'msg' => 'Successfully added student', 'title' => 'Success!');

        return response()->json($return);
    }

    public function updateStudentData(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');
        // dd($request->input());
        $student_id = $request->input("student_id");
        $column = $request->input("column");
        $value = $request->input("value");
        if ($request->hasFile('file')) {
            $users = DB::table('students')->where('student_id', $student_id)->first();
            if ($users->{$column}) {
                Storage::disk("public")->delete($users->{$column});
            }
            $value = $request->file('file')->store($column, 'public');
        }


        $formFields = array($column => $value);
        $query = DB::table('students')->where('student_id', $student_id)->update($formFields);

        if ($query) {
            $return = array('status' => 1, 'msg' => 'Successfully updated applicant', 'title' => 'Success!');
        }

        return response()->json($return);
    }

    public function testEmail()
    {
        $data = array(
            'subject' => "test",
            'body' => "Test email"
        );

        try {
            Mail::to("dutertehck@gmail.com")->send(new MailNotify($data));
            return response()->json(['Check your mail']);
        } catch (Exception $th) {
            return response()->json(['Something Went Wrong']);
        }
    }
}
