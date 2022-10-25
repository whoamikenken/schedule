<?php

namespace App\Http\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Extras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(Auth::user()->user_image);
        // auth()->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        $menus = DB::table('menus')->where('root', '=', '0')->get();
        // dd($data['menus']);
        foreach ($menus as $key => $value) {
            $data['menus'][$value->title] = json_decode(DB::table('menus')->where("root", "=", $value->menu_id)->orderBy("order", "asc")->get());
        }
        
        return view('home', $data);
    }

    public function dashboard(){
    
        if(Auth::user()->user_type == "Admin"){
        $data['registeredApplicantMonth'] = Extras::countApplicantRegistered();
        $data['upcomingDeparture'] = Extras::countUpcomingMonthDeparture();
        $data['active_applicant'] = Extras::countActiveApplicant();
        $data['expired_applicant'] = Extras::countExpiredPassportAndVisa();
        $data['top_sales'] = DB::table('users')->select("*", DB::raw('(SELECT COUNT(*) FROM applicants  WHERE MONTH(oec_flight_departure) = "10" AND YEAR(oec_flight_departure) = YEAR(CURDATE()) AND isactive = "Active" AND sales_manager = users.id) as total_sales'), DB::raw('(SELECT description FROM branches WHERE code = users.branch) as branchdesc'))->where("user_type", "=", 'Sales')->orderBy("total_sales", "desc")->paginate(8);
        
        // foreach ($data['top_sales'] as $key => $value) {
        //     $data['top_sales'][$key]->branch = DB::table('branches')->where('code', $value->branch)->value('description');
        // }

        return view('dashboard/admin', $data);
        }else{

        }
    }

    public function departureMontlyBarChart()
    {
        $start    = (new DateTime(date("Y-")."01-01"))->modify('first day of this month');
        $end      = (new DateTime(date("Y-") . "12-31"))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);

        // $highestAmounContribute = $this->setup->getHighestContribution();
        $highest = 0;
        $data = "[";
        $month = "[";
        foreach ($period as $dt) {
            
            $val = Extras::getDepartureMonth($dt->format("m"));
            if ($val != 0) {
                $data = $data . $val . ",";
                if ($val > $highest) $highest = $val;
            } else {
                $data = $data . "0,";
            }

            $month = $month . '"' . $dt->format("F") . '",';
        }
     
        $data = substr($data, 0, -1);
        $data = $data . "]";
        $month = substr($month, 0, -1);
        $month = $month . "]";
        $return['data'] = $data;
        $return['month'] = $month;
        $percentageAdded = (30 / 100) * $highest;
        $return['high'] = $highest + $percentageAdded;
        // echo '<pre>'; print_r(;die;
        echo json_encode($return);
    }

    public function performanceMontlyBarChart()
    {
        $start    = (new DateTime(date("Y-") . "01-01"))->modify('first day of this month');
        $end      = (new DateTime(date("Y-") . "12-31"))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);

        $highest = 0;
        $dataDeparture = $dataJo = $dataApplicant = "[";
        $month = "[";
        foreach ($period as $dt) {

            // Departure
            $valDept = Extras::getDepartureMonth($dt->format("m"));
            if ($valDept != 0) {
                $dataDeparture = $dataDeparture . $valDept . ",";
                if ($valDept > $highest) $highest = $valDept;
            } else {
                $dataDeparture = $dataDeparture . "0,";
            }

            // JobOrder
            $joDept = Extras::getJobOrderMonth($dt->format("m"));
            if ($joDept != 0) {
                $dataJo = $dataJo . $joDept . ",";
                if ($joDept > $highest) $highest = $joDept;
            } else {
                $dataJo = $dataJo . "0,";
            }

            // Applicant
            $applicantDept = Extras::getApplicantRegistered($dt->format("m"));
            if ($applicantDept != 0) {
                $dataApplicant = $dataApplicant . $applicantDept . ",";
                if ($applicantDept > $highest) $highest = $applicantDept;
            } else {
                $dataApplicant = $dataApplicant . "0,";
            }

            $month = $month . '"' . $dt->format("F") . '",';
        }

        // Departure
        $dataDeparture = substr($dataDeparture, 0, -1);
        $dataDeparture = $dataDeparture . "]";

        // JobOrder
        $dataJo = substr($dataJo, 0, -1);
        $dataJo = $dataJo . "]";

        // Applicant
        $dataApplicant = substr($dataApplicant, 0, -1);
        $dataApplicant = $dataApplicant . "]";

        $month = substr($month, 0, -1);
        $month = $month . "]";
        $return['departure']['data'] = $dataDeparture;
        $return['joborder']['data'] = $dataJo;
        $return['applicant']['data'] = $dataApplicant;

        $return['month'] = $month;
        $percentageAdded = (30 / 100) * $highest;
        $return['high'] = $highest + $percentageAdded;
        // echo '<pre>'; print_r(;die;
        echo json_encode($return);
    }

    public function branchMontlyBarChart()
    {
        $start    = (new DateTime(date("Y-") . "01-01"))->modify('first day of this month');
        $end      = (new DateTime(date("Y-") . "12-31"))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);
        
        $getBranchList = Extras::getBranchList();

        $return = $data = array();
        $highest = 0;
        $month = "[";
        
        foreach ($period as $dt) {
            $month = $month . '"' . $dt->format("F") . '",';
            foreach ($getBranchList as $key => $value) {
                $count = Extras::getBranchDeployedMonth($dt->format("m"), $value->code);
                $data['dataset'][$value->code]['label'] = $value->description;
                $data['dataset'][$value->code]['backgroundColor'] = $value->color;
                $data['dataset'][$value->code]['borderRadius'] = 5;
                $data['dataset'][$value->code]['borderWidth'] = 2;
                $data['dataset'][$value->code]['borderColor'] = $value->color;
                $data['dataset'][$value->code]['data'][] = $count;
                if ($count > $highest) $highest = $count;
            }
        }

        foreach ($data['dataset'] as $key => $value) {
            $return['dataset'][] = $value;
        }
        // dd($return);
        // dd($return['']);
        $month = substr($month, 0, -1);
        $month = $month . "]";

        $return['month'] = $month;
        $percentageAdded = (30 / 100) * $highest;
        $return['high'] = $highest + $percentageAdded;
        // echo '<pre>'; print_r(;die;
        echo json_encode($return);
    }

    public function branchPieApplicant()
    {
        $branchesResult = DB::table('branches')->get();

        $data = "[";
        $label = "[";
        foreach ($branchesResult as $key => $value) {

            $val = Extras::getApplicantInBranch($value->code);
            if ($val != 0) {
                $data = $data . $val . ",";
            } else {
                $data = $data . "0,";
            }

            $label = $label . '"' . $value->description . '",';
        }

        $data = substr($data, 0, -1);
        $data = $data . "]";
        $label = substr($label, 0, -1);
        $label = $label . "]";
        $return['data'] = $data;
        $return['label'] = $label;
        echo json_encode($return);
    }

    public function biostatusPieApplicant()
    {
        $bioStatus = Extras::getBioStatusDesc();

        $data = "[";
        $label = "[";
        foreach ($bioStatus as $key => $value) {

            $val = Extras::getApplicantCountWithBioStatus($value->bio_status);
            if ($val != 0) {
                $data = $data . $val . ",";
            } else {
                $data = $data . "0,";
            }

            $label = $label . '"' . $value->bio_status . ': '. $val.'",';
        }

        $data = substr($data, 0, -1);
        $data = $data . "]";
        $label = substr($label, 0, -1);
        $label = $label . "]";
        $return['data'] = $data;
        $return['label'] = $label;
        echo json_encode($return);
    }
}
