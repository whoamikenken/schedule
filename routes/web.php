<?php

use App\Models\Extras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DiplomaController;
use App\Http\Controllers\JobsiteController;
use App\Http\Controllers\MedicalController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UsertypeController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\TablecolumnController;
use App\Http\Controllers\PassportchopController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [LoginController::class, 'index']);

Route::get('/home', function(){

    $menus = DB::table('menus')->where('root', '=', '0')->get();
    foreach ($menus as $key => $value) {
        $data['menus'][$value->title] = json_decode(DB::table('menus')->where("root", "=", $value->menu_id)->orderBy("order", "asc")->get());
    }

    $data['navSelected'] = 1;
    $data['menuSelected'] = 5;

    $data['readAccess'] = explode(",", Extras::getAccessList("read", Auth::user()->username));
    $data['addAccess'] = explode(",", Extras::getAccessList("add", Auth::user()->username));
    $data['editAccess'] = explode(",", Extras::getAccessList("edit", Auth::user()->username));
    $data['deleteAccess'] = explode(",", Extras::getAccessList("delete", Auth::user()->username));

    return view('home', $data);

})->name('home')->middleware('auth');

Route::post('/home', function (Request $request) {
    $menus = DB::table('menus')->where('root', '=', '0')->get();
    foreach ($menus as $key => $value) {
        $data['menus'][$value->title] = json_decode(DB::table('menus')->where("root", "=", $value->menu_id)->orderBy("order", "asc")->get());
    }

    $data['navSelected'] = $request->nav;
    $data['menuSelected'] = $request->menu_id;

    $data['readAccess'] = explode(",", Extras::getAccessList("read", Auth::user()->username));
    $data['addAccess'] = explode(",", Extras::getAccessList("add", Auth::user()->username));
    $data['editAccess'] = explode(",", Extras::getAccessList("edit", Auth::user()->username));
    $data['deleteAccess'] = explode(",", Extras::getAccessList("delete", Auth::user()->username));
    return view($request->route, $data);
    
})->middleware('auth');

// JobSite
Route::post('/jobsite/table', [JobsiteController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/jobsite/getModal', [JobsiteController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/jobsite/add', [JobsiteController::class, 'store']);
Route::post('/jobsite/delete', [JobsiteController::class, 'delete']);

// Location
Route::post('/location/table', [LocationController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/location/getModal', [LocationController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/location/add', [LocationController::class, 'store']);
Route::post('/location/delete', [LocationController::class, 'delete']);

// Principal
Route::post('/principal/table', [PrincipalController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/principal/getModal', [PrincipalController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/principal/add', [PrincipalController::class, 'store']);
Route::post('/principal/delete', [PrincipalController::class, 'delete']);

// Medical
Route::post('/medical/table', [MedicalController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/medical/getModal', [MedicalController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/medical/add', [MedicalController::class, 'store']);
Route::post('/medical/delete', [MedicalController::class, 'delete']);

// Branch
Route::post('/branch/table', [BranchController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/branch/getModal', [BranchController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/branch/add', [BranchController::class, 'store']);
Route::post('/branch/delete', [BranchController::class, 'delete']);


// USER
Route::post('/user/table', [UserController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/user/getModal', [UserController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/user/add', [UserController::class, 'store']);
Route::post('/user/delete', [UserController::class, 'delete']);

// USER TYPE
Route::post('/usertype/table', [UsertypeController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/usertype/getModal', [UsertypeController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/usertype/add', [UsertypeController::class, 'store']);
Route::post('/usertype/delete', [UsertypeController::class, 'delete']);

// table column
Route::post('/tablecolumn/table', [TablecolumnController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/tablecolumn/getModal', [TablecolumnController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/tablecolumn/add', [TablecolumnController::class, 'store']);

// Reports
Route::post('/report/getModalFilter', [ReportsController::class, 'getModalFilter'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/report/generateReport', [ReportsController::class, 'generateReport'])->middleware('auth');

// Logout User
Route::post('/logout', [UserController::class, 'logout']);

// Loging user
Route::post('/login/validate', [UserController::class, 'validateLogin']);
Route::post('/login/register', [UserController::class, 'register']);

// DASHBAORD
Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth');
Route::get('/dashboard/getDashboard', [HomeController::class, 'dashboard'])->withoutMiddleware([VerifyCsrfToken::class])->middleware('auth');
Route::get('/dashboard/getDepartureMontly', [HomeController::class, 'departureMontlyBarChart'])->withoutMiddleware([VerifyCsrfToken::class])->middleware('auth');
Route::get('/dashboard/getPerformanceMontly', [HomeController::class, 'performanceMontlyBarChart'])->withoutMiddleware([VerifyCsrfToken::class])->middleware('auth');
Route::get('/dashboard/getPerformanceBranchMontly', [HomeController::class, 'branchMontlyBarChart'])->withoutMiddleware([VerifyCsrfToken::class])->middleware('auth');
Route::get('/dashboard/getBranchPie', [HomeController::class, 'branchPieApplicant'])->withoutMiddleware([VerifyCsrfToken::class])->middleware('auth');
Route::get('/dashboard/getBiostatusPie', [HomeController::class, 'biostatusPieApplicant'])->withoutMiddleware([VerifyCsrfToken::class])->middleware('auth');

// APPLICANT
Route::post('/applicant/list', [ApplicantController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/applicant/getModal', [ApplicantController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/applicant/getApplicantProfileTab', [ApplicantController::class, 'profileTab'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/applicant/add', [ApplicantController::class, 'store']);
Route::post('/applicant/store', [ApplicantController::class, 'updateApplicantData']);
Route::post('/applicant/profile', [ApplicantController::class, 'profile'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/applicant/record', [ApplicantController::class, 'record'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/applicant/document', [ApplicantController::class, 'document'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/applicant/oec', [ApplicantController::class, 'oec'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::get('/applicant/syncDataApplicant', [ApplicantController::class, 'syncApplicantData'])->withoutMiddleware([VerifyCsrfToken::class]);

// Test Email Function
Route::get('/applicant/testEmail', [ApplicantController::class, 'testEmail'])->withoutMiddleware([VerifyCsrfToken::class]);

// Passport Chop
Route::post('/passport/table', [PassportchopController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/passport/getModal', [PassportchopController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/passport/add', [PassportchopController::class, 'store']);
Route::post('/passport/delete', [PassportchopController::class, 'delete']);

// Diploma
Route::post('/diploma/table', [DiplomaController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/diploma/getModal', [DiplomaController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/diploma/add', [DiplomaController::class, 'store']);
Route::post('/diploma/delete', [DiplomaController::class, 'delete']);

// Certificate
Route::post('/certificate/table', [CertificateController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/certificate/getModal', [CertificateController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/certificate/add', [CertificateController::class, 'store']);
Route::post('/certificate/delete', [CertificateController::class, 'delete']);

Route::get('/credits', function(){
    echo "Created by kennedy hipolito<br>";
    echo "Email: whoamikenken@gmail.com<br>";
    echo "Contact: 09226361316<br>";
});


