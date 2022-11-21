<style>
    .custom-file-button input[type=file] {
        margin-left: -2px !important;
    }
    .custom-file-button input[type=file]::-webkit-file-upload-button {
        display: none;
    }
    .custom-file-button input[type=file]::file-selector-button {
        display: none;
    }
    .custom-file-button:hover label {
        background-color: #dde0e3;
        cursor: pointer;
    }
</style>

<div class="container-fluid p-0">
    <div class="card border-secondary mb-3 mt-4">
        <div class="card-header" style="font-size: 23px;background: #0d6cf9;color: white;">General Information</div>
        <div class="card-body text-secondary">
            <div class="row">
                <div class="col-sm-12 col-lg-4 text-center">
                    @if ($user_profile != "")
                    <img src="{{  Storage::disk("s3")->url($user_profile)}}" class="img-fluid rounded-start" alt="..." style="max-height: 268px;">
                    @else
                    <img src="{{ asset('images/user.png')}}" class="img-fluid rounded-start" alt="..." style="max-height: 268px;">
                    @endif
                    <br>
                    <div class="input-group custom-file-button mt-2">
                        <label class="input-group-text" for="user_profile">{{($user_profile != "")? "Replace":"Upload"}} Picture</label>
                        <input type="file" class="form-control form-control-sm" id="user_profile" name="user_profile">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Applicant ID.</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-pass"></i></div>
                            <input type="text" id="er_ref" name="er_ref"
                            class="form-control" placeholder="Enter ER Ref" value="{{ $id }}">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">First Name</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-person"></i></div>
                            <input type="text" id="fname" name="fname"
                            class="form-control validate" placeholder="Enter First Name" value="{{ $fname }}">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input a First Name.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Middle Name</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-person"></i></div>
                            <input type="text" id="mname" name="mname"
                            class="form-control validate" placeholder="Enter Middle Name" value="{{ $mname }}">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input a Middle Name.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Status</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-person-rolodex"></i></div>
                            <select name="applicant_type" id="applicant_type" class="form-control form-select">
                                <option value="PENDING" {{ (isset($applicant_type) && $applicant_type == "PENDING")? "selected":"" }} >PENDING</option>
                                <option value="ACCEPTED" {{ (isset($applicant_type) && $applicant_type == "ACCEPTED")? "selected":"" }} >APPROVE</option>
                                <option value="DISAPPROVE" {{ (isset($applicant_type) && $applicant_type == "DISAPPROVE")? "selected":"" }} >DISAPPROVE</option>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Campus</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-building"></i></div>
                            <select name="campus" id="campus" class="form-control form-select">
                                @foreach ($campuses_select as $item)
                                <option value="{{$item->code}}" {{ (isset($campus) && $campus == $item->code)? "selected":"" }} >{{$item->description}}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Year Level</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-building"></i></div>
                            <select name="year_level" id="year_level" class="form-control form-select">
                                @foreach ($yearlevels_select as $item)
                                <option value="{{$item->code}}" {{ (isset($year_level) && $year_level == $item->code)? "selected":"" }} >{{$item->description}}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Stundet ID</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-pass"></i></div>
                            <input type="text" id="student_no" name="student_no"
                            class="form-control" placeholder="Enter Student ID" required value="{{ $student_no }}">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Last Name</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-person"></i></div>
                            <input type="text" id="lname" name="lname"
                            class="form-control validate" placeholder="Enter Last Name" value="{{ $lname }}">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input a Last Name.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Contact</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-hash"></i></div>
                            <input type="text" id="contact" name="contact"
                            class="form-control validate" placeholder="Enter Contact" value="{{ $contact }}">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input a Contact.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Account Status</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-person-check"></i></div>
                            <select name="isactive" id="isactive" class="form-control form-select">
                                <option value="Active" {{ (isset($isactive) && $isactive == "Active")? "selected":"" }} >Active</option>
                                <option value="Inactive" {{ (isset($isactive) && $isactive == "Inactive")? "selected":"" }} >Terminated</option>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Course</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-building"></i></div>
                            <select name="course" id="course" class="form-control form-select">
                                @foreach ($courses_select as $item)
                                <option value="{{$item->code}}" {{ (isset($course) && $course == $item->code)? "selected":"" }} >{{$item->description}}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Section</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-building"></i></div>
                            <select name="section" id="section" class="form-control form-select">
                                @foreach ($sections_select as $item)
                                <option value="{{$item->code}}" {{ (isset($section) && $section == $item->code)? "selected":"" }} >{{$item->description}}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-12 offset-md-4">
                    <label style="font-weight:600">Address</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-geo-alt"></i></div>
                        <input type="text" id="address" name="address"
                        class="form-control validate" placeholder="Enter address" value="{{ $address }}">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input a address.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
        
        $('.form-select').select2({
            theme: 'bootstrap-5'
        });

        @if (!in_array("801", $editAccess))
            $("input").attr('disabled','disabled');
            $("select").attr('disabled','disabled');
        @endif
    });
    
    $('#userVideo').on('hidden.bs.modal', function (e) {
        $('video').trigger('pause');
    })
    
    
    $("input[type=text], input[type=file], input[type=number], textarea, select").on("change", function(){
        if ($(this).val()) {
            @if (!in_array("801", $editAccess))
                Swal.fire({
                    icon: 'error',
                    title: "You have no edit permission",
                    text: "This will be recorded."
                })
                $("input").attr('disabled','disabled');
                $("select").attr('disabled','disabled');
                setTimeout(() => {
                    $("#pills-tab").find(".active").click();
                }, 2000);
                return false;
            @else
                saveSingleProfileColumn($(this));
            @endif
            
        }else return;   
    });
    
</script>