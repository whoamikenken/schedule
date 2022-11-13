@extends('layouts.header')

@section('content')

@php
$campus_select = DB::table('campuses')->get();
$student_select = DB::table('students')->where("isactive","Active")->get();
@endphp

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Student Management</h1>
</div>
<div id="studentContainer">
    <div class="card shadow animate__animated animate__fadeInRight">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <a href="javascript:void(0);" class="btn btn-primary mb-2 addbtn"><i class="bi bi-plus-circle"></i> Add Student</a>
                </div>
                <div class="col-sm-12 col-md-5">
                    <div class="text-sm-end">
                    </div>
                </div><!-- end col-->
            </div><br>
            <form id="studentListForm">
                <input type="hidden" name="page" id="page" value="1">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Student</label>
                            <div class="col-sm-10">
                                <select name="student" id="student" class="form-select">
                                    <option value="" selected>All Student</option>
                                    @foreach ($student_select as $item)
                                    <option value="{{$item->student_id}}" >{{$item->student_id." - ".$item->lname." ".$item->fname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Campus</label>
                            <div class="col-sm-10">
                                <select name="campus" id="campus" class="form-select">
                                    <option value="" selected>All Campus</option>
                                    @foreach ($campus_select as $item)
                                    <option value="{{$item->code}}" >{{$item->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="row mb-3">
                        <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button class="btn btn-primary" id="searchStudent" type="button">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end card-body-->
    </div>
    <br><br>
    <div id="studentDiv">
        
    </div>
</div>

<script>
    
    $(document).ready(function () {
        $('.form-select').select2({
            theme: 'bootstrap-5'
        });
        StudentList();
    });
    
    $("#searchStudent").click(function() {
        StudentList();
    });
    
    function StudentList(){
        var formdata = $("#studentListForm").serialize();
        
        $.ajax({
            type: "POST",
            url: "{{ url('student/list')}}",
            data: formdata,
            async: false,
            success:function(response){
                $("#studentDiv").html(response);
            }
        });
    }
    
    $(".addbtn").click(function() {
        var uid = "add";
        $.ajax({
            type: "POST",
            url: "{{ url('student/getModal')}}",
            data: {
                uid: uid
            },
            success: function(response) {
                $("#modal-view").modal('toggle');
                $("#modal-view").find(".modal-title").text("Add Student");
                $("#modal-view").find("#modal-display").html(response);
            }
        });
    });
    
    $(document).on("click","#paginationStudent a, #search_btn",function(){
        //get url and make final url for ajax 
        var url=$(this).attr("href");
        var mystr = url.split("=");
        $("#page").val(mystr[1]);
        StudentList();
        return false;
    })

    $(document).on("click",".studentView",function(){
        var uid = $(this).attr('uid');
        $.ajax({
            type: "POST",
            url: "{{ url('student/getStudentProfileTab')}}",
            data: {
                uid: uid
            },
            success: function(response) {
                $("#studentContainer").html(response);
            }
        });
    })
</script>
@endsection
