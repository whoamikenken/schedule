@extends('layouts.header')

@section('content')

@php
$jobsite_select = DB::table('jobsites')->get();
$users_select = DB::table('users')->where("user_type","sales")->get();
$branch_select = DB::table('branches')->get();
$applicant_select = DB::table('applicants')->where("isactive","Active")->get();
@endphp

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Applicant Management</h1>
</div>
<div id="applicantContainer">
    <div class="card shadow animate__animated animate__fadeInRight">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <a href="javascript:void(0);" class="btn btn-primary mb-2 addbtn"><i class="bi bi-plus-circle"></i> Add Applicant</a>
                </div>
                <div class="col-sm-12 col-md-5">
                    <div class="text-sm-end">
                        {{-- <button type="button" class="btn btn-secondary mb-2"><i class="bi bi-printer"></i> Print</button> --}}
                    </div>
                </div><!-- end col-->
            </div><br>
            <form id="applicantListForm">
                <input type="hidden" name="page" id="page" value="1">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Applicant</label>
                            <div class="col-sm-10">
                                <select name="applicant" id="applicant" class="form-select">
                                    <option value="" selected>All Applicant</option>
                                    @foreach ($applicant_select as $item)
                                    <option value="{{$item->applicant_id}}" >{{$item->applicant_id." - ".$item->lname." ".$item->fname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Sales</label>
                            <div class="col-sm-10">
                                <select name="sales" id="sales" class="form-select">
                                    <option value="" selected>All Sales</option>
                                    @foreach ($users_select as $item)
                                    <option value="{{$item->id}}" >{{$item->lname." ".$item->fname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Branch</label>
                            <div class="col-sm-10">
                                <select name="branch" id="branch" class="form-select">
                                    <option value="" selected>All Branch</option>
                                    @foreach ($branch_select as $item)
                                    <option value="{{$item->code}}" >{{$item->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Jobsite</label>
                            <div class="col-sm-10">
                                <select name="jobsite" id="jobsite" class="form-select">
                                    <option value="" selected>All Jobsite</option>
                                    @foreach ($jobsite_select as $item)
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
                            <button class="btn btn-primary" id="searchApplicant" type="button">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end card-body-->
    </div>
    <br><br>
    <div id="applicantDiv">
        
    </div>
</div>

<script>
    
    $(document).ready(function () {
        $('.form-select').select2({
            theme: 'bootstrap-5'
        });
        ApplicantList();
    });
    
    $("#searchApplicant").click(function() {
        ApplicantList();
    });
    
    function ApplicantList(){
        var formdata = $("#applicantListForm").serialize();
        
        $.ajax({
            type: "POST",
            url: "{{ url('applicant/list')}}",
            data: formdata,
            async: false,
            success:function(response){
                $("#applicantDiv").html(response);
            }
        });
    }
    
    $(".addbtn").click(function() {
        var uid = "add";
        $.ajax({
            type: "POST",
            url: "{{ url('applicant/getModal')}}",
            data: {
                uid: uid
            },
            success: function(response) {
                $("#modal-view").modal('toggle');
                $("#modal-view").find(".modal-title").text("Add Applicant");
                $("#modal-view").find("#modal-display").html(response);
            }
        });
    });
    
    $(document).on("click","#paginationApplicant a, #search_btn",function(){
        //get url and make final url for ajax 
        var url=$(this).attr("href");
        var mystr = url.split("=");
        $("#page").val(mystr[1]);
        ApplicantList();
        return false;
    })

    $(document).on("click",".applicantView",function(){
        var uid = $(this).attr('uid');
        $.ajax({
            type: "POST",
            url: "{{ url('applicant/getApplicantProfileTab')}}",
            data: {
                uid: uid
            },
            success: function(response) {
                $("#applicantContainer").html(response);
            }
        });
    })
</script>
@endsection
