<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    //
    public function getTable(Request $request)
    {
        $filter = $request->input();

        $where = array();
        if ($filter['applicant_id']) $where[] = array('applicant_id', '=', $filter['applicant_id']);
        $data['certificate_result'] = DB::table('certificates')->where($where)->paginate(4);

        foreach ($data['certificate_result'] as $key => $value) {
            $data['certificate_result'][$key]->modified_by = DB::table('users')->where('id', $value->modified_by)->value('name');
            $data['certificate_result'][$key]->created_by = DB::table('users')->where('id', $value->created_by)->value('name');
        }

        return view('certificate/certificate_table', $data);
    }

    public function getModal(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        if ($formFields['uid'] != "add") {
            $data['record'] = DB::table('certificates')->where('id', $formFields['uid'])->get();
            $data = $data['record'][0];
            $data = json_decode(json_encode($data), true);
        }

        $data['uid'] = $formFields['uid'];
        // dd($data);
        return view('certificate/certificate_modal', $data);
    }

    public function store(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');

        $formFields = $request->validate([
            'uid' => ['required'],
            'applicant_id' => ['required'],
            'description' => ['required'],
            'certificate' => ['required', File::types(['jpg', 'png', 'jpeg', 'pdf'])],
        ]);
        // dd($request->hasFile('certificate'));
        if ($formFields['uid'] == "add") {
            unset($formFields['uid']);
            $formFields['created_by'] = Auth::id();
            $formFields['updated_at'] = "";
            if ($request->hasFile('certificate')) {
                $formFields['certificate'] = $request->file('certificate')->store('certificate', 's3');
            }
            Certificate::create($formFields);
            $return = array('status' => 1, 'msg' => 'Successfully added certificate', 'title' => 'Success!');
        } else {
            $formFields['updated_at'] = Carbon::now();
            $formFields['mofied_by'] = Auth::id();
            $id = $formFields['uid'];
            unset($formFields['uid']);
            if ($request->hasFile('certificate')) {
                $certificateData = DB::table('certificates')->where('id', $id)->first();
                if ($certificateData->certificate) {
                    Storage::disk('s3')->delete($certificateData->certificate);
                }
                $formFields['certificate'] = $request->file('certificate')->store('certificate', 's3');
            }
            DB::table('certificates')->where('id', $id)->update($formFields);
            $return = array('status' => 1, 'msg' => 'Successfully updated certificate', 'title' => 'Success!');
        }

        return response()->json($return);
    }

    public function delete(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');

        $formFields = $request->validate([
            'code' => ['required']
        ]);

        $delete = DB::table('certificates')->where('id', '=', $formFields['code'])->delete();

        if ($delete) {
            $return = array('status' => 1, 'msg' => 'Successfully deleted certificate', 'title' => 'Success!');
        }

        return response()->json($return);
    }
}
