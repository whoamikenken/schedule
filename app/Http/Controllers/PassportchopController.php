<?php

namespace App\Http\Controllers;

use App\Models\Tablecolumn;
use App\Models\Passportchop;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class PassportchopController extends Controller
{
    //
    public function getTable(Request $request)
    {
        $filter = $request->input();
        
        $where = array();
        if($filter['applicant_id']) $where[] = array('applicant_id', '=', $filter['applicant_id']);
        $data['passportchop_result'] = DB::table('passport_chops')->where($where)->paginate(4);

        foreach ($data['passportchop_result'] as $key => $value) {
            $data['passportchop_result'][$key]->modified_by = DB::table('users')->where('id', $value->modified_by)->value('name');
            $data['passportchop_result'][$key]->created_by = DB::table('users')->where('id', $value->created_by)->value('name');
        }
        // dd($data);
        return view('passport/passport_table', $data);
    }

    public function getModal(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        if ($formFields['uid'] != "add") {
            $data['record'] = DB::table('passport_chops')->where('id', $formFields['uid'])->get();
            $data = $data['record'][0];
            $data = json_decode(json_encode($data), true);
        }

        $data['uid'] = $formFields['uid'];
        // dd($data);
        return view('passport/passport_modal', $data);
    }

    public function store(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');

        $formFields = $request->validate([
            'uid' => ['required'],
            'applicant_id' => ['required'],
            'remarks' => ['required'],
            'chops' => ['required', File::types(['jpg','png','jpeg', 'pdf'])],
        ]);
        // dd($request->hasFile('chops'));
        if ($formFields['uid'] == "add") {
            unset($formFields['uid']);
            $formFields['created_by'] = Auth::id();
            $formFields['updated_at'] = "";
            if ($request->hasFile('chops')) {
                $formFields['chops'] = $request->file('chops')->store('chops', 's3');
            }
            Passportchop::create($formFields);
            $return = array('status' => 1, 'msg' => 'Successfully added passport', 'title' => 'Success!');
        } else {
            $formFields['updated_at'] = Carbon::now();
            $formFields['modified_by'] = Auth::id();
            $id = $formFields['uid'];
            unset($formFields['uid']);
            if ($request->hasFile('chops')) {
                $passportData = DB::table('passport_chops')->where('id', $id)->first();
                if ($passportData->chops) {
                    Storage::disk('s3')->delete($passportData->chops);
                }
                $formFields['chops'] = $request->file('chops')->store('chops', 's3');
            }
            DB::table('passport_chops')->where('id', $id)->update($formFields);
            $return = array('status' => 1, 'msg' => 'Successfully updated passport', 'title' => 'Success!');
        }

        return response()->json($return);
    }

    public function delete(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');

        $formFields = $request->validate([
            'code' => ['required']
        ]);

        $delete = DB::table('passport_chops')->where('id', '=', $formFields['code'])->delete();

        if ($delete) {
            $return = array('status' => 1, 'msg' => 'Successfully deleted passport chops', 'title' => 'Success!');
        }

        return response()->json($return);
    }
}
