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
                <div class="col-sm-12 col-lg-2 text-center">
                    @if ($user_profile_face != "")
                    <img src="{{  Storage::disk('s3')->url($user_profile_face)}}" class="img-fluid rounded-start" alt="..." style="max-height: 268px;">
                    @else
                    <img src="{{ asset('images/user.png')}}" class="img-fluid rounded-start" alt="..." style="max-height: 268px;">
                    @endif
                    <br>
                    <div class="input-group custom-file-button mt-2">
                        <label class="input-group-text" for="user_profile_face">{{($user_profile_face != "")? "Replace":"Upload"}} Picture</label>
                        <input type="file" class="form-control form-control-sm" id="user_profile_face" name="user_profile_face">
                    </div><br>
                    <div class="input-group custom-file-button mb-2">
                        <label class="input-group-text" for="user_video">{{($user_video != "")? "Replace":"Upload"}} Video</label>
                        <input type="file" class="form-control form-control-sm" id="user_video" name="user_video">
                    </div>
                </div>
                <div class="col-sm-12 col-lg-2 text-center">
                    <form id="PictureForm" enctype="multipart/form-data">
                        @if ($user_profile != "")
                        <img src="{{  Storage::disk('s3')->url($user_profile)}}" class="img-fluid rounded-start" alt="..." style="max-height: 268px;">
                        @else
                        <img src="{{ asset('images/user.png')}}" class="img-fluid rounded-start" alt="..." style="max-height: 268px;">
                        @endif
                        <br>
                        <div class="input-group custom-file-button mt-1">
                            <label class="input-group-text" for="user_profile">{{($user_profile != "")? "Replace":"Upload"}} Picture</label>
                            <input type="file" class="form-control form-control-sm" id="user_profile" name="user_profile">
                        </div><br>
                        @if ($user_video != "")
                        <a class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#userVideo">View Video</a>
                        @endif
                    </form>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">ER Ref.</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-pass"></i></div>
                            <input type="text" id="er_ref" name="er_ref"
                            class="form-control" placeholder="Enter ER Ref" value="{{ $er_ref }}">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Applicant ID</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-pass"></i></div>
                            <input type="text" id="applicant_id" name="applicant_id"
                            class="form-control" placeholder="Enter Applicant ID" required value="{{ $applicant_id }}">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Branch</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-building"></i></div>
                            <select name="branch" id="branch" class="form-control form-select">
                                @foreach ($branch_select as $item)
                                <option value="{{$item->code}}" {{ (isset($branch) && $branch == $item->code)? "selected":"" }} >{{$item->description}}</option>
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
                        <label style="font-weight:600">Applicant Type</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-person-rolodex"></i></div>
                            <select name="applicant_type" id="applicant_type" class="form-control form-select">
                                <option value="Maid" {{ (isset($applicant_type) && $applicant_type == "Maid")? "selected":"" }} >Maid</option>
                                <option value="Caregiver" {{ (isset($applicant_type) && $applicant_type == "Caregiver")? "selected":"" }} >Care Giver</option>
                                <option value="Driver" {{ (isset($applicant_type) && $applicant_type == "Driver")? "selected":"" }} >Driver</option>
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
                    @if (in_array("999", $readAccess))
                        <div class="col-md-12 col-sm-12">
                            <label style="font-weight:600">Total Cost</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-receipt"></i></div>
                                <input type="number" id="total_cost" name="total_cost" class="form-control validate" placeholder="Enter total_cost" value="{{ $total_cost }}" readonly>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please input a cost.
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Maid Ref</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-pass"></i></div>
                            <input type="text" id="maid_ref" name="maid_ref"
                            class="form-control" placeholder="Enter Maid Ref" value="{{ $maid_ref }}">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Job Site</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-geo"></i></div>
                            <select name="jobsite" id="jobsite" class="form-control form-select">
                                @foreach ($jobsite_select as $item)
                                <option value="{{$item->code}}" {{ (isset($jobsite) && $jobsite == $item->code)? "selected":"" }} >{{$item->description}}</option>
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
                        <label style="font-weight:600">Sales Manager</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-file-earmark-person"></i></div>
                            <select name="sales_manager" id="sales_manager" class="form-control form-select">
                                @foreach ($users_select as $item)
                                <option value="{{$item->id}}" {{ (isset($sales_manager) && $sales_manager == $item->id)? "selected":"" }} >{{$item->name}}</option>
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
                        <label style="font-weight:600">Principal</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-building"></i></div>
                            <select name="principal" id="principal" class="form-control form-select">
                                @foreach ($principal_select as $item)
                                <option value="{{$item->code}}" {{ (isset($principal) && $principal == $item->code)? "selected":"" }} >{{$item->description}}</option>
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
                </div>
            </div>
        </div>
    </div>
    <div class="card border-secondary mb-3 mt-4">
        <div class="card-header" style="font-size: 23px;background: #0d6cf9;color: white;">Applicant Information</div>
        <div class="card-body text-secondary">
            <div class="row">
                <div class="col-sm-12 col-lg-4">
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Family Contact Name</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-person"></i></div>
                            <input type="text" id="family_contact_name" name="family_contact_name"
                            class="form-control" placeholder="Enter Family Contact Name" value="{{$family_contact_name}}">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Been Abroad</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-person-check"></i></div>
                            <select name="is_ex_abroad" id="is_ex_abroad" class="form-control form-select">
                                <option value="Yes" {{ (isset($is_ex_abroad) && $is_ex_abroad == "Yes")? "selected":"" }} >Yes</option>
                                <option value="No" {{ (isset($is_ex_abroad) && $is_ex_abroad == "No")? "selected":"" }} >No</option>
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
                <div class="col-sm-12 col-lg-4">
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Family Contact No</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-hash"></i></div>
                            <input type="text" id="family_contact" name="family_contact" class="form-control" placeholder="Enter Family Contact No." value="{{$family_contact}}">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">First Time</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-person-check"></i></div>
                            <select name="is_first" id="is_first" class="form-control form-select">
                                <option value="Yes" {{ (isset($is_first) && $is_first == "Yes")? "selected":"" }} >Yes</option>
                                <option value="No" {{ (isset($is_first) && $is_first == "No")? "selected":"" }} >No</option>
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
                <div class="col-sm-12 col-lg-4">
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Date Applied</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                            <input type="text" id="date_applied" name="date_applied" class="form-control datepicker" value="{{ $date_applied }}">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Abroad Experience</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-123"></i></div>
                            <input type="number" id="abroad_experience" name="abroad_experience" class="form-control" placeholder="Enter Year Of Experience." value="{{$abroad_experience}}">
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
        </div>
    </div>
    <div class="card border-secondary mb-3 mt-4">
        <div class="card-header" style="font-size: 23px;background: #0d6cf9;color: white;">Vaccination Information</div>
        <div class="card-body text-secondary">
            <h5 class="text-center mt-2">First Vaccination</h5>
            <hr>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-4">
                    <label style="font-weight:600">Vacinne Date</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="vac_first_dose_date" name="vac_first_dose_date" class="form-control datepicker" value="{{ $vac_first_dose_date }}" placeholder="Select date">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input.
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-4">
                    <label style="font-weight:600">Vacinne Brand</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-eyedropper"></i></div>
                        <select name="vac_first_brand" id="vac_first_brand" class="form-control form-select">
                            <option value="Pfizer" {{ (isset($vac_first_brand) && $vac_first_brand == "Pfizer")? "selected":"" }} >Pfizer</option>
                            <option value="AstraZeneca" {{ (isset($vac_first_brand) && $vac_first_brand == "AstraZeneca")? "selected":"" }} >AstraZeneca</option>
                            <option value="Sinovac" {{ (isset($vac_first_brand) && $vac_first_brand == "Sinovac")? "selected":"" }} >Sinovac</option>
                            <option value="Sputnik" {{ (isset($vac_first_brand) && $vac_first_brand == "Sputnik")? "selected":"" }} >Sputnik</option>
                            <option value="JandJ" {{ (isset($vac_first_brand) && $vac_first_brand == "JandJ")? "selected":"" }} >Jonhson and Jonhson`s</option>
                            <option value="Pfizer" {{ (isset($vac_first_brand) && $vac_first_brand == "Pfizer")? "selected":"" }} >Pfizer</option>
                            <option value="Bharat" {{ (isset($vac_first_brand) && $vac_first_brand == "Bharat")? "selected":"" }} >Bharat BioTech</option>
                            <option value="Moderna" {{ (isset($vac_first_brand) && $vac_first_brand == "Moderna")? "selected":"" }} >Moderna</option>
                            <option value="Novavax" {{ (isset($vac_first_brand) && $vac_first_brand == "Novavax")? "selected":"" }} >Novavax</option>
                        </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input.
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-4">
                    <label style="font-weight:600">Country Vacinnated</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-geo-alt"></i></div>
                        <select name="vac_first_country" id="vac_first_country" class="form-control form-select">
                            @foreach ($country_select as $item)
                            <option value="{{$item->code}}" {{ (isset($vac_first_country) && $vac_first_country == $item->code)? "selected":"" }} >{{$item->description}}</option>
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
            <h5 class="text-center mt-2">Second Vaccination</h5>
            <hr>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-4">
                    <label style="font-weight:600">Vacinne Date</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="vac_second_dose_date" name="vac_second_dose_date" class="form-control datepicker" value="{{ $vac_second_dose_date }}" placeholder="Select date">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input.
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-4">
                    <label style="font-weight:600">Vacinne Brand</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-eyedropper"></i></div>
                        <select name="vac_second_brand" id="vac_second_brand" class="form-control form-select">
                            <option value="Pfizer" {{ (isset($vac_second_brand) && $vac_second_brand == "Pfizer")? "selected":"" }} >Pfizer</option>
                            <option value="AstraZeneca" {{ (isset($vac_second_brand) && $vac_second_brand == "AstraZeneca")? "selected":"" }} >AstraZeneca</option>
                            <option value="Sinovac" {{ (isset($vac_second_brand) && $vac_second_brand == "Sinovac")? "selected":"" }} >Sinovac</option>
                            <option value="Sputnik" {{ (isset($vac_second_brand) && $vac_second_brand == "Sputnik")? "selected":"" }} >Sputnik</option>
                            <option value="JandJ" {{ (isset($vac_second_brand) && $vac_second_brand == "JandJ")? "selected":"" }} >Jonhson and Jonhson`s</option>
                            <option value="Pfizer" {{ (isset($vac_second_brand) && $vac_second_brand == "Pfizer")? "selected":"" }} >Pfizer</option>
                            <option value="Bharat" {{ (isset($vac_second_brand) && $vac_second_brand == "Bharat")? "selected":"" }} >Bharat BioTech</option>
                            <option value="Moderna" {{ (isset($vac_second_brand) && $vac_second_brand == "Moderna")? "selected":"" }} >Moderna</option>
                            <option value="Novavax" {{ (isset($vac_second_brand) && $vac_second_brand == "Novavax")? "selected":"" }} >Novavax</option>
                        </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input.
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-4">
                    <label style="font-weight:600">Country Vacinnated</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-geo-alt"></i></div>
                        <select name="vac_second_country" id="vac_second_country" class="form-control form-select">
                            @foreach ($country_select as $item)
                            <option value="{{$item->code}}" {{ (isset($vac_second_country) && $vac_second_country == $item->code)? "selected":"" }} >{{$item->description}}</option>
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
            <h5 class="text-center mt-2">Booster Vaccination</h5>
            <hr>
            <div class="row">
                <div class="col-md-12 col-sm- col-lg-4">
                    <label style="font-weight:600">Vacinne Date</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="vac_booster_dose_date" name="vac_booster_dose_date" class="form-control datepicker" value="{{ $vac_booster_dose_date }}" placeholder="Select date">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input.
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-4">
                    <label style="font-weight:600">Vacinne Brand</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-eyedropper"></i></div>
                        <select name="vac_booster_brand" id="vac_booster_brand" class="form-control form-select">
                            <option value="Pfizer" {{ (isset($vac_booster_brand) && $vac_booster_brand == "Pfizer")? "selected":"" }} >Pfizer</option>
                            <option value="AstraZeneca" {{ (isset($vac_booster_brand) && $vac_booster_brand == "AstraZeneca")? "selected":"" }} >AstraZeneca</option>
                            <option value="Sinovac" {{ (isset($vac_booster_brand) && $vac_booster_brand == "Sinovac")? "selected":"" }} >Sinovac</option>
                            <option value="Sputnik" {{ (isset($vac_booster_brand) && $vac_booster_brand == "Sputnik")? "selected":"" }} >Sputnik</option>
                            <option value="JandJ" {{ (isset($vac_booster_brand) && $vac_booster_brand == "JandJ")? "selected":"" }} >Jonhson and Jonhson`s</option>
                            <option value="Pfizer" {{ (isset($vac_booster_brand) && $vac_booster_brand == "Pfizer")? "selected":"" }} >Pfizer</option>
                            <option value="Bharat" {{ (isset($vac_booster_brand) && $vac_booster_brand == "Bharat")? "selected":"" }} >Bharat BioTech</option>
                            <option value="Moderna" {{ (isset($vac_booster_brand) && $vac_booster_brand == "Moderna")? "selected":"" }} >Moderna</option>
                            <option value="Novavax" {{ (isset($vac_booster_brand) && $vac_booster_brand == "Novavax")? "selected":"" }} >Novavax</option>
                        </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input.
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-4">
                    <label style="font-weight:600">Country Vacinnated</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-geo-alt"></i></div>
                        <select name="vac_country" id="vac_country" class="form-control form-select">
                            @foreach ($country_select as $item)
                            <option value="{{$item->code}}" {{ (isset($vac_country) && $vac_country == $item->code)? "selected":"" }} >{{$item->description}}</option>
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
    </div>
</div>
<div class="card border-secondary mb-3 mt-4">
    <div class="card-header" style="font-size: 23px;background: #0d6cf9;color: white;">Biodata Status</div>
    <div class="card-body text-secondary">
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="col-md-12 col-sm-12">
                    <label style="font-weight:600">Biodata Transferred Date</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="bio_trans_date" name="bio_trans_date" class="form-control datepicker" value="{{ $bio_trans_date }}" placeholder="Select date">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input.
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <label style="font-weight:600">Biodata Lunched Date</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="bio_lunch_date" name="bio_lunch_date" class="form-control datepicker" value="{{ $bio_lunch_date }}" placeholder="Select date">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="col-md-12 col-sm-12">
                    <label style="font-weight:600">Biodata Status</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select name="bio_status" id="bio_status" class="form-control form-select">
                            <option value="Pending" {{ (isset($bio_status) && $bio_status == "Pending")? "selected":"" }} >Pending</option>
                            <option value="Approved" {{ (isset($bio_status) && $bio_status == "Approved")? "selected":"" }} >Approved</option>
                            <option value="Disapproved" {{ (isset($bio_status) && $bio_status == "Disapproved")? "selected":"" }} >Disapproved</option>
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
                    <label style="font-weight:600">Biodata Availability</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select name="bio_availability" id="bio_availability" class="form-control form-select">
                            <option value="Sold" {{ (isset($bio_availability) && $bio_availability == "Sold")? "selected":"" }} >Sold</option>
                            <option value="Available" {{ (isset($bio_availability) && $bio_availability == "Available")? "selected":"" }} >Available</option>
                            <option value="Signed Up" {{ (isset($bio_availability) && $bio_availability == "Signed Up")? "selected":"" }} >Signed Up</option>
                            <option value="Pending" {{ (isset($bio_availability) && $bio_availability == "Pending")? "selected":"" }} >Pending</option>
                            <option value="Backed out" {{ (isset($bio_availability) && $bio_availability == "Backed out")? "selected":"" }} >Backed out</option>
                            <option value="Resell/Push" {{ (isset($bio_availability) && $bio_availability == "Resell/Push")? "selected":"" }} >Resell/Push</option>
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
    </div>
</div>
<div class="card border-secondary mb-3 mt-4">
    <div class="card-header" style="font-size: 23px;background: #0d6cf9;color: white;">Medical Information</div>
    <div class="card-body text-secondary">
        <h5 class="text-center">First Medical</h5>
        <hr>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-6">
                <label style="font-weight:600">Medical Date</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                    <input type="text" id="med_first_date" name="med_first_date" class="form-control datepicker" value="{{ $med_first_date }}" placeholder="Select date">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input.
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-6">
                <label style="font-weight:600">Expiration Date</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                    <input type="text" id="med_first_expiration" name="med_first_expiration" class="form-control datepicker" value="{{ $med_first_expiration }}" placeholder="Select date">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input.
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <label style="font-weight:600">Medical Clinic</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-option"></i></div>
                    <select name="med_first_clinic" id="med_first_clinic" class="form-control form-select">
                        @foreach ($medical_select as $item)
                        <option value="{{$item->code}}" {{ (isset($med_first_clinic) && $med_first_clinic == $item->code)? "selected":"" }} >{{$item->description}}</option>
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
            <div class="col-md-12 col-sm-12 col-lg-6">
                <label style="font-weight:600">Medical Result</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-option"></i></div>
                    <input type="text" id="med_first_result" name="med_first_result" class="form-control" list="datalistOptionsResult" value="{{ $med_first_result }}">
                </div>
            </div>
        </div>
        @if (in_array("999", $readAccess))
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <label style="font-weight:600">Is Done?</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-question-circle-fill"></i></div>
                    <select name="med_first_done" id="med_first_done" class="form-control form-select">
                        <option value="Yes" {{ (isset($med_first_done) && $med_first_done == "Yes")? "selected":"" }} >Yes</option>
                        <option value="No" {{ (isset($med_first_done) && $med_first_done == "No")? "selected":"" }} >No</option>
                    </select>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input.
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <label style="font-weight:600">Medical Cost</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-receipt"></i></div>
                    <input type="number" id="med_first_cost" name="med_first_cost" class="form-control" placeholder="Enter Medical Cost" value="{{$med_first_cost}}">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input.
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <label style="font-weight:600">Medical Certificate</label>
                <div class="input-group custom-file-button">
                    <label class="input-group-text" for="med_first_cert"><i class="bi bi-file-earmark-text"></i>&nbsp;&nbsp;{{($med_first_cert != "")? "Replace":"Upload"}} Certificate</label>
                    <input type="file" class="form-control form-control-sm" id="med_first_cert" name="med_first_cert">
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                @if ($med_first_cert != "")
                <label style="font-weight:600">Medical Certificate</label>
                <div class="input-group">
                    <a class="btn btn-info text-white" target="_blank" href="{{  Storage::disk('s3')->url($med_first_cert)}}"><i class="bi bi-eye"></i> View</a>
                </div>
                @endif
            </div>
        </div>
        <h5 class="text-center mt-2">Second Medical</h5>
        <hr>
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <label style="font-weight:600">Medical Date</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                    <input type="text" id="med_second_date" name="med_second_date" class="form-control datepicker" value="{{ $med_second_date }}" placeholder="Select date">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input.
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-6">
                <label style="font-weight:600">Expiration Date</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                    <input type="text" id="med_second_expiration" name="med_second_expiration" class="form-control datepicker" value="{{ $med_second_expiration }}" placeholder="Select date">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input.
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-6">
                <label style="font-weight:600">Medical Clinic</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-option"></i></div>
                    <select name="med_second_clinic" id="med_second_clinic" class="form-control form-select">
                        @foreach ($medical_select as $item)
                        <option value="{{$item->code}}" {{ (isset($med_second_clinic) && $med_second_clinic == $item->code)? "selected":"" }} >{{$item->description}}</option>
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
            <div class="col-md-12 col-lg-6">
                <label style="font-weight:600">Medical Result</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-option"></i></div>
                    <input type="text" id="med_second_result" name="med_second_result" class="form-control" list="datalistOptionsResult" value="{{ $med_second_result }}">
                </div>
            </div>
        </div>
        @if (in_array("999", $readAccess))
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <label style="font-weight:600">Is Done?</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-question-circle-fill"></i></div>
                    <select name="med_second_done" id="med_second_done" class="form-control form-select">
                        <option value="Yes" {{ (isset($med_second_done) && $med_second_done == "Yes")? "selected":"" }} >Yes</option>
                        <option value="No" {{ (isset($med_second_done) && $med_second_done == "No")? "selected":"" }} >No</option>
                    </select>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input.
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-6">
                <label style="font-weight:600">Medical Cost</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-receipt"></i></div>
                    <input type="number" id="med_second_cost" name="med_second_cost" class="form-control" placeholder="Enter Medical Cost" value="{{$med_second_cost}}">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input.
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <label style="font-weight:600">Medical Certificate</label>
                <div class="input-group custom-file-button">
                    <label class="input-group-text" for="med_second_cert"><i class="bi bi-file-earmark-text"></i>&nbsp;&nbsp;{{($med_second_cert != "")? "Replace":"Upload"}} Certificate</label>
                    <input type="file" class="form-control form-control-sm" id="med_second_cert" name="med_second_cert">
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                @if ($med_second_cert != "")
                <label style="font-weight:600">Medical Certificate</label>
                <div class="input-group">
                    <a class="btn btn-info text-white" target="_blank" href="{{  Storage::disk('s3')->url($med_second_cert)}}"><i class="bi bi-eye"></i> View</a>
                </div>
                @endif
            </div>
        </div>
        <h5 class="text-center mt-2">Third Medical</h5>
        <hr>
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <label style="font-weight:600">Medical Date</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                    <input type="text" id="med_third_date" name="med_third_date" class="form-control datepicker" value="{{ $med_third_date }}" placeholder="Select date">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input.
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-6">
                <label style="font-weight:600">Expiration Date</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                    <input type="text" id="med_third_expiration" name="med_third_expiration" class="form-control datepicker" value="{{ $med_third_expiration }}" placeholder="Select date">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input.
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-6">
                <label style="font-weight:600">Medical Clinic</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-option"></i></div>
                    <select name="med_third_clinic" id="med_third_clinic" class="form-control form-select">
                        @foreach ($medical_select as $item)
                        <option value="{{$item->code}}" {{ (isset($med_third_clinic) && $med_third_clinic == $item->code)? "selected":"" }} >{{$item->description}}</option>
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
            <div class="col-md-12 col-lg-6">
                <label style="font-weight:600">Medical Result</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-option"></i></div>
                    <input type="text" id="med_third_result" name="med_third_result" class="form-control" list="datalistOptionsResult" value="{{ $med_third_result }}">
                </div>
            </div>
        </div>
        @if (in_array("999", $readAccess))
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-6">
                <label style="font-weight:600">Is Done?</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-question-circle-fill"></i></div>
                    <select name="med_third_done" id="med_third_done" class="form-control form-select">
                        <option value="Yes" {{ (isset($med_third_done) && $med_third_done == "Yes")? "selected":"" }} >Yes</option>
                        <option value="No" {{ (isset($med_third_done) && $med_third_done == "No")? "selected":"" }} >No</option>
                    </select>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input.
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-6">
                <label style="font-weight:600">Medical Cost</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-receipt"></i></div>
                    <input type="number" id="med_third_cost" name="med_third_cost" class="form-control" placeholder="Enter Medical Cost" value="{{$med_third_cost}}">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input.
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <label style="font-weight:600">Medical Certificate</label>
                <div class="input-group custom-file-button">
                    <label class="input-group-text" for="med_third_cert"><i class="bi bi-file-earmark-text"></i>&nbsp;&nbsp;{{($med_third_cert != "")? "Replace":"Upload"}} Certificate</label>
                    <input type="file" class="form-control form-control-sm" id="med_third_cert" name="med_third_cert">
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                @if ($med_third_cert != "")
                <label style="font-weight:600">Medical Certificate</label>
                <div class="input-group">
                    <a class="btn btn-info text-white" target="_blank" href="{{  Storage::disk('s3')->url($med_third_cert)}}"><i class="bi bi-eye"></i> View</a>
                </div>
                @endif
            </div>
        </div>
        <h5 class="text-center mt-2">Fourth Medical</h5>
        <hr>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-6">
                <label style="font-weight:600">Medical Date</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                    <input type="text" id="med_fourth_date" name="med_fourth_date" class="form-control datepicker" value="{{ $med_fourth_date }}" placeholder="Select date">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input.
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-6">
                <label style="font-weight:600">Expiration Date</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                    <input type="text" id="med_fourth_expiration" name="med_fourth_expiration" class="form-control datepicker" value="{{ $med_fourth_expiration }}" placeholder="Select date">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input.
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-6">
                <label style="font-weight:600">Medical Clinic</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-option"></i></div>
                    <select name="med_fourth_clinic" id="med_fourth_clinic" class="form-control form-select">
                        @foreach ($medical_select as $item)
                        <option value="{{$item->code}}" {{ (isset($med_fourth_clinic) && $med_fourth_clinic == $item->code)? "selected":"" }} >{{$item->description}}</option>
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
            <div class="col-md-12 col-sm-12 col-lg-6">
                <label style="font-weight:600">Medical Result</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-option"></i></div>
                    <input type="text" id="med_fourth_result" name="med_fourth_result" class="form-control" list="datalistOptionsResult" value="{{ $med_fourth_result }}">
                </div>
            </div>
        </div>
        @if (in_array("999", $readAccess))
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-6">
                <label style="font-weight:600">Is Done?</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-question-circle-fill"></i></div>
                    <select name="med_fourth_done" id="med_fourth_done" class="form-control form-select">
                        <option value="Yes" {{ (isset($med_fourth_done) && $med_fourth_done == "Yes")? "selected":"" }} >Yes</option>
                        <option value="No" {{ (isset($med_fourth_done) && $med_fourth_done == "No")? "selected":"" }} >No</option>
                    </select>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input.
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-6">
                <label style="font-weight:600">Medical Cost</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="bi bi-receipt"></i></div>
                    <input type="number" id="med_fourth_cost" name="med_fourth_cost" class="form-control" placeholder="Enter Medical Cost" value="{{$med_fourth_cost}}">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please input.
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <label style="font-weight:600">Medical Certificate</label>
                <div class="input-group custom-file-button">
                    <label class="input-group-text" for="med_fourth_cert"><i class="bi bi-file-earmark-text"></i>&nbsp;&nbsp;{{($med_fourth_cert != "")? "Replace":"Upload"}} Certificate</label>
                    <input type="file" class="form-control form-control-sm" id="med_fourth_cert" name="med_fourth_cert">
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                @if ($med_fourth_cert != "")
                <label style="font-weight:600">Medical Certificate</label>
                <div class="input-group">
                    <a class="btn btn-info text-white" target="_blank" href="{{  Storage::disk('s3')->url($med_fourth_cert)}}"><i class="bi bi-eye"></i> View</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>   
<div class="modal fade" id="userVideo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userVideoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userVideoLabel">{{ $fname." ".$lname}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <video class="video-js vjs-theme-sea mx-auto d-block"
                id="my-video"
                class="video-js"
                controls
                preload="auto"
                width="336"
                height="656"
                poster="{{  Storage::disk('s3')->url($user_profile)}}"
                data-setup="{}"
                >
                <source src="{{  Storage::disk('s3')->url($user_video)}}" type="video/mp4" />
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that
                        <a href="{{  Storage::disk('s3')->url($user_video)}}" target="_blank"
                            >supports HTML5 video</a
                            >
                        </p>
                    </video>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        <datalist id="datalistOptionsResult">
        <option value="Fit to work">
        <option value="Unfit">
        <option value="Pending">
        </datalist>
<script src="https://vjs.zencdn.net/7.20.2/video.min.js"></script>
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