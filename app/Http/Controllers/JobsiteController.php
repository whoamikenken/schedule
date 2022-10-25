<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jobsite;
use App\Models\Tablecolumn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobsiteController extends Controller
{
    public function index()
    {
        // dd(Auth::user()->user_image);
        // auth()->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        $data['menus'] = DB::table('menus')->get();
        // dd($users);
        return view('setup/jobsite', $data);
    }

    public function getTable(){
        $data['result'] = DB::table('jobsites')->get();
        
        // get user creator
        foreach ($data['result'] as $key => $value) {
            
            $data['result'][$key]->modified_by = DB::table('users')->where('id', $value->modified_by)->value('name');
            $data['result'][$key]->created_by = DB::table('users')->where('id', $value->created_by)->value('name');
        }

        $data['columns'] = Tablecolumn::getColumn("jobsites");

        return view('setup/jobsite_table', $data);
    }

    public function getModal(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        

        if ($formFields['uid'] != "add") {
            $data['record'] = DB::table('jobsites')->where('id', $formFields['uid'])->get();
            $data = $data['record'][0];
            $data = json_decode(json_encode($data), true);
        }

        $data['uid'] = $formFields['uid'];
        // dd($data);
        return view('setup/jobsite_modal', $data);
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
            Jobsite::create($formFields);
            $return = array('status' => 1, 'msg' => 'Successfully added jobsite', 'title' => 'Success!');
        } else {
            $formFields['updated_at'] = Carbon::now();
            $formFields['modified_by'] = Auth::id();
            $id = $formFields['uid'];
            unset($formFields['uid']);
            DB::table('jobsites')->where('id', $id)->update($formFields);
            $return = array('status' => 1, 'msg' => 'Successfully updated jobsite', 'title' => 'Success!');
        }

        return response()->json($return);
    }

    public function delete(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');

        $formFields = $request->validate([
            'code' => ['required']
        ]);

        $delete = DB::table('jobsites')->where('id', '=', $formFields['code'])->delete();

        if($delete){
            $return = array('status' => 1, 'msg' => 'Successfully deleted jobsite', 'title' => 'Success!');
        }

        return response()->json($return);

    }

}
