<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Carbon\Carbon;
use App\Models\Tablecolumn;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Yearlevel;

class SubjectController extends Controller
{
    public function index()
    {
        $data['menus'] = DB::table('menus')->get();
        return view('setup/subject', $data);
    }

    public function getTable()
    {
        $data['result'] = DB::table("subjects")->get();

        // get user creator
        foreach ($data['result'] as $key => $value) {

            $data['result'][$key]->modified_by = DB::table('users')->where('id', $value->modified_by)->value('name');
            $data['result'][$key]->created_by = DB::table('users')->where('id', $value->created_by)->value('name');
        }

        $data['columns'] = Tablecolumn::getColumn("subjects");
        // dd($data);
        return view('setup/subject_table', $data);
    }

    public function getModal(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        if ($formFields['uid'] != "add") {
            $data['record'] = DB::table("subjects")->where('id', $formFields['uid'])->get();
            $data = $data['record'][0];
            $data = json_decode(json_encode($data), true);
        }

        $data['uid'] = $formFields['uid'];
        // dd($data);
        return view('setup/subject_modal', $data);
    }

    public function store(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');

        $formFields = $request->validate([
            'uid' => ['required'],
            'course_code' => ['required'],
            'course_desc' => ['required']
        ]);

        if ($formFields['uid'] == "add") {
            unset($formFields['uid']);
            $formFields['created_by'] = Auth::id();
            $formFields['updated_at'] = "";
            Subject::create($formFields);
            $return = array('status' => 1, 'msg' => 'Successfully added subject', 'title' => 'Success!');
        } else {
            $formFields['updated_at'] = Carbon::now();
            $formFields['modified_by'] = Auth::id();
            $id = $formFields['uid'];
            unset($formFields['uid']);
            DB::table("subjects")->where('id', $id)->update($formFields);
            $return = array('status' => 1, 'msg' => 'Successfully updated subject', 'title' => 'Success!');
        }

        return response()->json($return);
    }

    public function delete(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');

        $formFields = $request->validate([
            'code' => ['required']
        ]);

        $delete = DB::table("subjects")->where('id', '=', $formFields['code'])->delete();

        if ($delete) {
            $return = array('status' => 1, 'msg' => 'Successfully deleted subject', 'title' => 'Success!');
        }

        return response()->json($return);
    }

    public function syncSubjectData()
    {
        set_time_limit(0);

        $subjectList = DB::table("subjects")->get();
        
        foreach ($subjectList as $key => $value) {
            // Insert Course
            $courseCode = array();
            $courseCode['code'] = $value->subject_area;
            $courseCode['description'] = "test";
            $checkIfExist = DB::table('courses')->where('code', $value->subject_area)->get();
            if (count($checkIfExist) === 0) {
                Courses::create($courseCode);
            }

            // Insert Year Level
            $yearLevel = array();
            $yearLevel['code'] = $value->subject_area;
            $yearLevel['description'] = "test";
            $checkIfExistYR = DB::table('yearlevels')->where('code', $value->year_level)->get();
            if (count($checkIfExistYR) === 0) {
                Yearlevel::create($yearLevel);
            }

        }
    }
}
