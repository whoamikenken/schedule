<?php

namespace App\Http\Controllers;

use App\Models\Extras;
use App\Models\Applicant;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\MailNotify;

class ApplicantController extends Controller
{
    //

    public function getTable(Request $request)
    {
        $filter = $request->input();
        
        $where = array();
        if($filter['applicant']) $where[] = array('applicant_id', '=', $filter['applicant']);
        if($filter['sales']) $where[] = array('sales_manager', '=', $filter['sales']);
        if($filter['branch']) $where[] = array('branch', '=', $filter['branch']);
        if($filter['jobsite']) $where[] = array('jobsite', '=', $filter['jobsite']);
        $data['result'] = DB::table('applicants')->where($where)->paginate(8);
        foreach ($data['result'] as $key => $value) {
            $data['result'][$key]->sales_manager = DB::table('users')->where('id', $value->sales_manager)->value('name');
            $data['result'][$key]->jobsite = DB::table('jobsites')->where('code', $value->jobsite)->value('description');
            $data['result'][$key]->branch = DB::table('branches')->where('code', $value->branch)->value('description');
        }
        return view('user/applicant_list', $data);
    }

    public function getModal(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        $data['uid'] = $formFields['uid'];
        
        $data['jobsite_select'] = DB::table('jobsites')->get();
        $data['branch_select'] = DB::table('branches')->get();
        $data['users_select'] = DB::table('users')->where("user_type", "sales")->get();

        // dd($data);
        return view('user/applicant_modal', $data);
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
        return view('user/applicant_tab', $data);
    }

    public function profile(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        $data['uid'] = $formFields['uid'];

        $data['record'] = DB::table('applicants')->where("applicant_id", $data['uid'])->get();
        $data = json_decode($data['record'], true)[0];
        $data['jobsite_select'] = DB::table('jobsites')->get();
        $data['branch_select'] = DB::table('branches')->get();
        $data['country_select'] = DB::table('countries')->get();
        $data['medical_select'] = DB::table('medical')->get();
        $data['principal_select'] = DB::table('principals')->get();
        $data['users_select'] = DB::table('users')->where("user_type", "sales")->get();

        $data['readAccess'] = explode(",", Extras::getAccessList("read", Auth::user()->username));
        $data['editAccess'] = explode(",", Extras::getAccessList("edit", Auth::user()->username));

        return view('user/applicant_profile', $data);
    }

    public function record(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        $data['uid'] = $formFields['uid'];

        $data['record'] = DB::table('applicants')->where("applicant_id", $data['uid'])->get();
        $data = json_decode($data['record'], true)[0];
        $data['country_select'] = DB::table('countries')->get();

        $data['editAccess'] = explode(",", Extras::getAccessList("edit", Auth::user()->username));

        return view('user/applicant_record', $data);
    }

    public function document(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        $data['uid'] = $formFields['uid'];

        $data['record'] = DB::table('applicants')->where("applicant_id", $data['uid'])->get();
        $data = json_decode($data['record'], true)[0];

        $data['editAccess'] = explode(",", Extras::getAccessList("edit", Auth::user()->username));

        return view('user/applicant_document', $data);
    }

    public function oec(Request $request)
    {
        $data = array();

        $formFields = $request->validate([
            'uid' => ['required'],
        ]);

        $data['uid'] = $formFields['uid'];

        $data['record'] = DB::table('applicants')->where("applicant_id", $data['uid'])->get();
        $data = json_decode($data['record'], true)[0];

        $data['readAccess'] = explode(",", Extras::getAccessList("read", Auth::user()->username));
        $data['editAccess'] = explode(",", Extras::getAccessList("edit", Auth::user()->username));

        return view('user/applicant_oec', $data);
    }

    public function store(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');
        dd($request->input());
        $formFields = $request->validate([
            'applicant_id' => ['required'],
            'fname' => ['required'],
            'lname' => ['required'],
            'mname' => ['required'],
            'contact' => ['required'],
            'branch' => ['required'],
            'jobsite' => ['required'],
            'sales_manager' => ['required'],
        ]);

        unset($formFields['uid']);
        Applicant::create($formFields);
        $return = array('status' => 1, 'msg' => 'Successfully added applicant', 'title' => 'Success!');

        return response()->json($return);
    }

    public function updateApplicantData(Request $request)
    {
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');
        // dd($request->input());
        $applicant_id = $request->input("applicant_id");
        $column = $request->input("column");
        $value = $request->input("value");
        if ($request->hasFile('file')) {
            $users = DB::table('applicants')->where('applicant_id', $applicant_id)->first();
                if ($users->{$column}) {
                    Storage::disk('s3')->delete($users->{$column});
                }
                $value = $request->file('file')->store($column, 's3');
        }

        
        $formFields = array($column => $value);
        $query = DB::table('applicants')->where('applicant_id', $applicant_id)->update($formFields);

        if ($column == "med_first_cost" || $column == "med_second_cost" || $column == "med_third_cost" || $column == "med_fourth_cost" || $column == "cert_nc2_cost") {
            $users = DB::table('applicants')->where('applicant_id', $applicant_id)->first();
            $total_cost = $users->med_first_cost + $users->med_second_cost + $users->med_third_cost + $users->med_fourth_cost + $users->cert_nc2_cost;
            $NewTotalCost = array('total_cost' => $total_cost);
            DB::table('applicants')->where('applicant_id', $applicant_id)->update($NewTotalCost);
        }

        if ($query) {
            $return = array('status' => 1, 'msg' => 'Successfully updated applicant', 'title' => 'Success!');
        }
        
        return response()->json($return);
    }

    public function syncApplicantData(Request $request)
    {
        set_time_limit(0);
        
        $return = array('status' => 0, 'msg' => 'Error', 'title' => 'Error!');
        
        $data = array(
            'username' => 'kennedy',
            'password' => 'kennedy888'
        );

        $resultLogin = Extras::requestToEmpsys("https://api-empsysv3.technic.com.hk/v3/login", "post", $data);
        $resultLogin = json_decode($resultLogin);
        // dd($resultLogin);
        $token = $resultLogin->token;

        $dataApplicantCount = array(
            'page' => 1,
            'page_item' => 1,
            'agent_agency' => "",
            'status' => "",
        );

        $result = Extras::requestToEmpsys("https://api-empsysv3.technic.com.hk/v3/applicant/list", "get", $dataApplicantCount, $token);
        $result = json_decode($result);
       
        $total = $result->data->total;
        
        $dataApplicant = array(
            'page' => 1,
            'page_item' => $total,
            'agent_agency' => "",
            'status' => "",
        );

        $resultAll = Extras::requestToEmpsys("https://api-empsysv3.technic.com.hk/v3/applicant/list", "get", $dataApplicant, $token);
        $resultAll = json_decode($resultAll);
        
        $applicantList = $resultAll->data->data;
        
        $syncApplicant = 0;
        foreach ($applicantList as $key => $value) {
            
            $dataApplicantID = array(
                'id' => $value->id,
                // 'id' => '8000',
            );
            sleep(2);
            $resultApplicantInfo = Extras::requestToEmpsys("https://api-empsysv3.technic.com.hk/v3/applicant/details", "get", $dataApplicantID, $token);
            $resultApplicantInfo = json_decode($resultApplicantInfo);
            // dd($resultApplicantInfo);
            $applicantDataEmpSys = $resultApplicantInfo->data->applicant;
            
            $applicantData = array();
            // Assigning Data
            $applicantData['maid_ref'] = $applicantDataEmpSys->maid_full_code;
            $applicantData['applicant_id'] = $applicantDataEmpSys->id;
            $applicantData['applicant_type'] = $applicantDataEmpSys->type;
            $applicantData['user_profile'] = $applicantDataEmpSys->head_img_path;
            $applicantData['user_profile_face'] = $applicantDataEmpSys->half_body_img_path;
            $applicantData['user_video'] = $applicantDataEmpSys->video_path;
            $applicantData['fname'] = $applicantDataEmpSys->first_name;
            $applicantData['mname'] = $applicantDataEmpSys->middle_name;
            $applicantData['lname'] = $applicantDataEmpSys->last_name;
            $applicantData['gender'] = $applicantDataEmpSys->gender;
            $applicantData['passport_place_issued'] = ($applicantDataEmpSys->passport_country == "Philippines")? "PH": $applicantDataEmpSys->passport_country;
            $applicantData['passport_validity'] = ($applicantDataEmpSys->passport_validity)? date("Y-m-d", strtotime($applicantDataEmpSys->passport_validity)): NULL;
            $applicantData['visa_date_expired'] = ($applicantDataEmpSys->visa_expiry_date) ? date("Y-m-d", strtotime($applicantDataEmpSys->visa_expiry_date)) : NULL;
            $applicantData['bio_availability'] = $applicantDataEmpSys->maid_status;
            $applicantData['created_at'] = ($applicantDataEmpSys->created_at) ? date("Y-m-d", strtotime($applicantDataEmpSys->created_at)) : NULL;
            
            $applicantChecker = Extras::isExist("applicants", $applicantDataEmpSys->id, "applicant_id");
            if($applicantChecker){
                DB::table('applicants')->where('applicant_id', $applicantData['applicant_id'])->update($applicantData);
            }else{
                Applicant::create($applicantData);
            }
            $syncApplicant++;
        }
        
        if ($syncApplicant != 0) {
            $return = array('status' => 1, 'msg' => 'Successfully sync '.$syncApplicant.' applicants', 'title' => 'Success!');
        }

        return response()->json($return);
    }

    public function testEmail(){
        $data = array(
                    'subject' => "test",
                    'body' => "Test email"
                );

        try {
            Mail::to("dutertehck@gmail.com")->send(New MailNotify($data));
            return response()->json(['Check your mail']);
        } catch (Exception $th) {
            return response()->json(['Something Went Wrong']);
        }
    }
}
