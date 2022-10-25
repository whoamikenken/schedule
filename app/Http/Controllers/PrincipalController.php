<?php

namespace App\Http\Controllers;

use App\Models\Principal;
use App\Models\Tablecolumn;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PrincipalController extends Controller
{
    public function index()
    {
        // dd(Auth::user()->user_image);
        // auth()->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        $data['menus'] = DB::table('menus')->get();
        // dd($users);
        return view('setup/principal', $data);
    }

    public function getTable()
    {
        $data['result'] = DB::table('principals')->get();

        // get user creator
        foreach ($data['result'] as $key => $value) {

            $data['result'][$key]->modified_by = DB::table('users')->where('id', $value->modified_by)->value('name');
            $data['result'][$key]->created_by = DB::table('users')->where('id', $value->created_by)->value('name');
            $data['result'][$key]->jobsite = DB::table('jobsites')->where('code', $value->jobsite)->value('description');
        }

        $data['columns'] = Tablecolumn::getColumn("principals");
        
        return view('setup/principal_table', $data);
    }

    public function getModal(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        if ($formFields['uid'] != "add") {
            $data['record'] = DB::table('principals')->where('id', $formFields['uid'])->get();
            $data = $data['record'][0];
            $data = json_decode(json_encode($data), true);
        }

        $data['uid'] = $formFields['uid'];

        $data['jobsite_select'] = DB::table('jobsites')->get();
        // dd($data);
        return view('setup/principal_modal', $data);
    }

    public function store(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');

        $formFields = $request->validate([
            'uid' => ['required'],
            'code' => ['required'],
            'jobsite' => ['required'],
            'description' => ['required']
        ]);

        if ($formFields['uid'] == "add") {
            unset($formFields['uid']);
            $formFields['created_by'] = Auth::id();
            $formFields['updated_at'] = "";
            Principal::create($formFields);
            $return = array('status' => 1, 'msg' => 'Successfully added principal', 'title' => 'Success!');
        } else {
            $formFields['updated_at'] = Carbon::now();
            $formFields['modified_by'] = Auth::id();
            $id = $formFields['uid'];
            unset($formFields['uid']);
            DB::table('principals')->where('id', $id)->update($formFields);
            $return = array('status' => 1, 'msg' => 'Successfully updated principal', 'title' => 'Success!');
        }

        return response()->json($return);
    }

    public function delete(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');

        $formFields = $request->validate([
            'code' => ['required']
        ]);

        $delete = DB::table('principals')->where('id', '=', $formFields['code'])->delete();

        if ($delete) {
            $return = array('status' => 1, 'msg' => 'Successfully deleted principal', 'title' => 'Success!');
        }

        return response()->json($return);
    }
}
