<?php

namespace App\Http\Controllers;

use App\Models\Tablecolumn;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\BatchSchedule;
use Illuminate\Support\Facades\Auth;

class BatchScheduleController extends Controller
{
    //
    public function index()
    {
        $data['menus'] = DB::table('menus')->get();
        return view('setup/batchscheduling', $data);
    }

    public function getTable()
    {
        $data['result'] = DB::table("batch_schedules")->get();

        // get user creator
        foreach ($data['result'] as $key => $value) {

            $data['result'][$key]->modified_by = DB::table('users')->where('id', $value->modified_by)->value('name');
            $data['result'][$key]->created_by = DB::table('users')->where('id', $value->created_by)->value('name');
        }

        $data['columns'] = Tablecolumn::getColumn("batch_schedules");
        // dd($data);
        return view('setup/batchscheduling_table', $data);
    }

    public function getModal(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        if ($formFields['uid'] != "add") {
            $data['record'] = DB::table("batch_schedules")->where('id', $formFields['uid'])->get();
            $data = $data['record'][0];
            $data = json_decode(json_encode($data), true);
        }

        $data['uid'] = $formFields['uid'];
        $data['sched_select'] = DB::table("schedules")->get();
        $data['course_select'] = DB::table("courses")->get();
        $data['yearlevel_select'] = DB::table("yearlevels")->get();
        // dd($data);
        return view('setup/batchscheduling_modal', $data);
    }

    public function store(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');

        $formFields = $request->validate([
            'uid' => ['required'],
            'sched_id' => ['required'],
            'yearlevel' => ['required'],
            'course' => ['required'],
            'section' => ['required']
        ]);
        dd($formFields);
        if ($formFields['uid'] == "add") {
            unset($formFields['uid']);
            $formFields['created_by'] = Auth::id();
            $formFields['updated_at'] = "";
            BatchSchedule::create($formFields);
            $return = array('status' => 1, 'msg' => 'Successfully added schedule', 'title' => 'Success!');
        } else {
            $formFields['updated_at'] = Carbon::now();
            $formFields['modified_by'] = Auth::id();
            $id = $formFields['uid'];
            unset($formFields['uid']);
            DB::table("batch_schedules")->where('id', $id)->update($formFields);
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

        $delete = DB::table("batch_schedules")->where('id', '=', $formFields['code'])->delete();

        if ($delete) {
            $return = array('status' => 1, 'msg' => 'Successfully deleted schedule', 'title' => 'Success!');
        }

        return response()->json($return);
    }
}
