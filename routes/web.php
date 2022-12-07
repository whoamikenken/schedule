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
use App\Http\Controllers\BatchScheduleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
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
})->name('landing');

Route::match(['get', 'post'], '/login', [LoginController::class, 'index'])->name('login');

Route::match(['get', 'post'], '/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

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

// Batch Schedule
Route::post('/batchschedule/table', [BatchScheduleController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/batchschedule/getModal', [BatchScheduleController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/batchschedule/add', [BatchScheduleController::class, 'store']);
Route::post('/batchschedule/delete', [BatchScheduleController::class, 'delete']);

// Schedule
Route::post('/schedule/table', [ScheduleController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/schedule/getModal', [ScheduleController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/schedule/add', [ScheduleController::class, 'store']);
Route::post('/schedule/delete', [ScheduleController::class, 'delete']);

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
Route::get('/dashboard/getPerformanceCampusMontly', [HomeController::class, 'campusMontlyBarChart'])->withoutMiddleware([VerifyCsrfToken::class])->middleware('auth');
Route::get('/dashboard/getCampusPie', [HomeController::class, 'campusPieStudent'])->withoutMiddleware([VerifyCsrfToken::class])->middleware('auth');
Route::get('/dashboard/getUserPie', [HomeController::class, 'getUserPieCount'])->withoutMiddleware([VerifyCsrfToken::class])->middleware('auth');

// APPLICANT
Route::post('/applicant/list', [ApplicantController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/applicant/getModal', [ApplicantController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/applicant/getApplicantProfileTab', [ApplicantController::class, 'profileTab'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/applicant/add', [ApplicantController::class, 'store']);
Route::post('/applicant/store', [ApplicantController::class, 'updateApplicantData']);
Route::post('/applicant/profile', [ApplicantController::class, 'profile'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/applicant/saveApplicant', [ApplicantController::class, 'saveApplicant'])->withoutMiddleware([VerifyCsrfToken::class]);

// STUDENT
Route::post('/student/list', [StudentController::class, 'getTable'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/student/getModal', [StudentController::class, 'getModal'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/student/getStudentProfileTab', [StudentController::class, 'profileTab'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/student/add', [StudentController::class, 'store']);
Route::post('/student/store', [StudentController::class, 'updateStudentData']);
Route::post('/student/profile', [StudentController::class, 'profile'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/student/schedule', [StudentController::class, 'schedule'])->withoutMiddleware([VerifyCsrfToken::class]);

// Test Email Function
Route::get('/applicant/testEmail', [ApplicantController::class, 'testEmail'])->withoutMiddleware([VerifyCsrfToken::class]);

Route::get('/subject/syncDataSubject', [SubjectController::class, 'syncSubjectData'])->withoutMiddleware([VerifyCsrfToken::class]);


// DropDown
Route::post('/getDropdown/dropdown', [HomeController::class, 'getDropdownData'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/getDropdown/dropdownInit', [HomeController::class, 'getDropdownDataInit'])->withoutMiddleware([VerifyCsrfToken::class]);




