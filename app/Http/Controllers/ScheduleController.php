<?php

namespace App\Http\Controllers;

use App\Models\Extras;
use App\Models\Schedule;
use App\Models\Tablecolumn;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    //
    public function index()
    {
        $data['menus'] = DB::table('menus')->get();
        return view('setup/schedule', $data);
    }

    public function getTable()
    {
        $data['result'] = DB::table("schedules")->get();

        // get user creator
        foreach ($data['result'] as $key => $value) {

            $data['result'][$key]->modified_by = DB::table('users')->where('id', $value->modified_by)->value('name');
            $data['result'][$key]->created_by = DB::table('users')->where('id', $value->created_by)->value('name');
        }

        $data['columns'] = Tablecolumn::getColumn("schedules");
        // dd($data);
        return view('setup/schedule_table', $data);
    }

    public function getModal(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        if ($formFields['uid'] != "add") {
            $data['record'] = DB::table("schedules")->where('id', $formFields['uid'])->get();
            $data = $data['record'][0];
            $data = json_decode(json_encode($data), true);
        }

        $data['uid'] = $formFields['uid'];
        $data['dow'] =
        array("M" => "Monday", "T" => "Tuesday", "W" => "Wednesday", "TH" => "Thursday", "F" => "Friday", "S" => "Saturday", "SUN" => "Sunday");
        $data['sched_per_day'] = array();
        foreach ($data['dow'] as $dow_code => $dow_desc) {
            $where = array();
            $where[] = array('dayofweek', $dow_code);
            if($formFields['uid'] != "add") {
                $where[] = array('schedid',$formFields['uid']);
            }
            $sched = DB::table('schedules_detail')->where($where)->get();
            $data['sched_per_day'][$dow_code] = $sched;
        }

        $data['subject_select'] = Extras::getSubjectForDropdown();
        
        return view('setup/schedule_modal', $data);
    }

    public function store(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');

        $formFields = $request->validate([
            'uid' => ['required'],
            'code' => ['required'],
            'description' => ['required']
        ]);

        if ($formFields['uid'] == "add") {
            unset($formFields['uid']);
            $formFields['created_by'] = Auth::id();
            $formFields['updated_at'] = "";
            Schedule::create($formFields);
            $return = array('status' => 1, 'msg' => 'Successfully added schedule', 'title' => 'Success!');
        } else {
            $formFields['updated_at'] = Carbon::now();
            $formFields['modified_by'] = Auth::id();
            $id = $formFields['uid'];
            unset($formFields['uid']);
            DB::table("schedules")->where('id', $id)->update($formFields);
            $return = array('status' => 1, 'msg' => 'Successfully updated schedule', 'title' => 'Success!');
        }

        return response()->json($return);
    }

    public function delete(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');

        $formFields = $request->validate([
            'code' => ['required']
        ]);

        $delete = DB::table("schedules")->where('id', '=', $formFields['code'])->delete();

        if ($delete) {
            $return = array('status' => 1, 'msg' => 'Successfully deleted schedule', 'title' => 'Success!');
        }

        return response()->json($return);
    }
}
