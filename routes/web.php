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
use App\Http\Controllers\CampusController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsertypeController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TablecolumnController;
use App\Http\Controllers\YearlevelController;

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

Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/home', function(){

    $menus = DB::table('menus')->where('root', '=', '0')->get();
    foreach ($menus as $key => $value) {
        if($value->link) $data['menus'][$value->title] = $value;
        else $data['menus'][$value->title] = json_decode(DB::table('menus')->where("root", "=", $value->menu_id)->orderBy("order", "asc")->get());
    }

    $data['navSelected'] = 0;
    $data['menuSelected'] = 1;

    $data['readAccess'] = explode(",", Extras::getAccessList("read", Auth::user()->username));
    $data['addAccess'] = explode(",", Extras::getAccessList("add", Auth::user()->username));
    $data['editAccess'] = explode(",", Extras::getAccessList("edit", Auth::user()->username));
    $data['deleteAccess'] = explode(",", Extras::getAccessList("delete", Auth::user()->username));

    return view('home', $data);

})->name('home')->middleware('auth');

Route::post('/home', function (Request $request) {
    $menus = DB::table('menus')->where('root', '=', '0')->get();
    foreach ($menus as $key => $value) {
        if ($value->link) $data['menus'][$value->title] = $value;
        else $data['menus'][$value->title] = json_decode(DB::table('menus')->where("root", "=", $value->menu_id)->orderBy("order", "asc")->get());
    }

    $data['navSelected'] = $request->nav;
    $data['menuSelected'] = $request->menu_id;

    $data['readAccess'] = explode(",", Extras::getAccessList("read", Auth::user()->username));
    $data['addAccess'] = explode(",", Extras::getAccessList("add", Auth::user()->username));
    $data['editAccess'] = explode(",", Extras::getAccessList("edit", Auth::user()->username));
    $data['deleteAccess'] = explode(",", Extras::getAccessList("delete", Auth::user()->username));
    return view($request->route, $data);
    
})->middleware('auth');

// Course
Route::post('/course/table', [CoursesController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/course/getModal', [CoursesController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/course/add', [CoursesController::class, 'store']);
Route::post('/course/delete', [CoursesController::class, 'delete']);

// Campus
Route::post('/campus/table', [CampusController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/campus/getModal', [CampusController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/campus/add', [CampusController::class, 'store']);
Route::post('/campus/delete', [CampusController::class, 'delete']);

// Section
Route::post('/section/table', [SectionController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/section/getModal', [SectionController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/section/add', [SectionController::class, 'store']);
Route::post('/section/delete', [SectionController::class, 'delete']);

// Subject
Route::post('/subject/table', [SubjectController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/subject/getModal', [SubjectController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/subject/add', [SubjectController::class, 'store']);
Route::post('/subject/delete', [SubjectController::class, 'delete']);

// Year Level
Route::post('/yearlevel/table', [YearlevelController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/yearlevel/getModal', [YearlevelController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/yearlevel/add', [YearlevelController::class, 'store']);
Route::post('/yearlevel/delete', [YearlevelController::class, 'delete']);

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

Route::get('/credits', function(){
    echo "Created by kennedy hipolito<br>";
    echo "Email: whoamikenken@gmail.com<br>";
    echo "Contact: 09226361316<br>";
});


