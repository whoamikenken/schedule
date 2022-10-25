<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Diploma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class DiplomaController extends Controller
{
    //
    public function getTable(Request $request)
    {
        $filter = $request->input();

        $where = array();
        if ($filter['applicant_id']) $where[] = array('applicant_id', '=', $filter['applicant_id']);
        $data['diploma_result'] = DB::table('diplomas')->where($where)->paginate(4);

        foreach ($data['diploma_result'] as $key => $value) {
            $data['diploma_result'][$key]->modified_by = DB::table('users')->where('id', $value->modified_by)->value('name');
            $data['diploma_result'][$key]->created_by = DB::table('users')->where('id', $value->created_by)->value('name');
        }
        // dd($data);
        return view('diploma/diploma_table', $data);
    }

    public function getModal(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        if ($formFields['uid'] != "add") {
            $data['record'] = DB::table('diplomas')->where('id', $formFields['uid'])->get();
            $data = $data['record'][0];
            $data = json_decode(json_encode($data), true);
        }

        $data['uid'] = $formFields['uid'];
        // dd($data);
        return view('diploma/diploma_modal', $data);
    }

    public function store(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');

        $formFields = $request->validate([
            'uid' => ['required'],
            'applicant_id' => ['required'],
            'type' => ['required'],
            'remarks' => ['required'],
            'diploma' => ['required', File::types(['jpg', 'png', 'jpeg', 'pdf'])],
        ]);
        // dd($request->hasFile('diploma'));
        if ($formFields['uid'] == "add") {
            unset($formFields['uid']);
            $formFields['created_by'] = Auth::id();
            $formFields['updated_at'] = "";
            if ($request->hasFile('diploma')) {
                $formFields['diploma'] = $request->file('diploma')->store('diploma', 's3');
            }
            Diploma::create($formFields);
            $return = array('status' => 1, 'msg' => 'Successfully added diploma', 'title' => 'Success!');
        } else {
            $formFields['updated_at'] = Carbon::now();
            $formFields['modified_by'] = Auth::id();
            $id = $formFields['uid'];
            unset($formFields['uid']);
            if ($request->hasFile('diploma')) {
                $diplomaData = DB::table('diplomas')->where('id', $id)->first();
                if ($diplomaData->diploma) {
                    Storage::disk('s3')->delete($diplomaData->diploma);
                }
                $formFields['diploma'] = $request->file('diploma')->store('diploma', 's3');
            }
            DB::table('diplomas')->where('id', $id)->update($formFields);
            $return = array('status' => 1, 'msg' => 'Successfully updated diploma', 'title' => 'Success!');
        }

        return response()->json($return);
    }

    public function delete(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');

        $formFields = $request->validate([
            'code' => ['required']
        ]);

        $delete = DB::table('diplomas')->where('id', '=', $formFields['code'])->delete();

        if ($delete) {
            $return = array('status' => 1, 'msg' => 'Successfully deleted diploma', 'title' => 'Success!');
        }

        return response()->json($return);
    }
}
