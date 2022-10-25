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
        <div class="card-header" style="font-size: 23px;background: #0d6cf9;color: white;">Passport Information</div>
        <div class="card-body text-secondary">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-6">
                    <label style="font-weight:600">Passport No.</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-person"></i></div>
                        <input type="text" id="passport_no" name="passport_no"
                        class="form-control" placeholder="Enter Passport No" value="{{$passport_no}}">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input.
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-6">
                    <label style="font-weight:600">Issued On</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="passport_issued" name="passport_issued" class="form-control datepicker" value="{{ $passport_issued }}" placeholder="Select date passport issued">
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
                    <label style="font-weight:600">Country Issued</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-geo-alt"></i></div>
                        <select name="passport_place_issued" id="passport_place_issued" class="form-control form-select">
                            @foreach ($country_select as $item)
                            <option value="{{$item->code}}" {{ (isset($passport_place_issued) && $passport_place_issued == $item->code)? "selected":"" }} >{{$item->description}}</option>
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
                    <label style="font-weight:600">Expiration</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="passport_validity" name="passport_validity" class="form-control datepicker" value="{{ $passport_validity }}" placeholder="Select date expiration">
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
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Passport</label>
                    <div class="input-group custom-file-button">
                        <label class="input-group-text" for="passport"><i class="bi bi-file-earmark-text"></i>&nbsp;&nbsp;{{($passport != "")? "Replace":"Upload"}} Passport</label>
                        <input type="file" class="form-control form-control-sm" id="passport" name="passport">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    @if ($passport != "")
                    <label style="font-weight:600">Current Passport</label>
                    <div class="input-group">
                        <a class="btn btn-info text-white" target="_blank" href="{{Storage::disk('s3')->url($passport)}}"><i class="bi bi-eye"></i> View</a>
                    </div>
                    @endif
                </div>
            </div>
            <h5 class="text-center mt-2">Passport Chops</h5>
            <hr>
            <div class="row mt-2">
                <div class="col-sm-12">
                    <a href="javascript:void(0);" class="btn btn-primary mb-2 addbtnPassport"><i class="bi bi-plus-circle"></i> Add Passport Chop</a>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive" id="passportchopTable">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="card border-secondary mb-3 mt-4">
        <div class="card-header" style="font-size: 23px;background: #0d6cf9;color: white;">VISA Information</div>
        <div class="card-body text-secondary">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-6">
                    <label style="font-weight:600">Visa No.</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-person"></i></div>
                        <input type="text" id="visa_number" name="visa_number"
                        class="form-control" placeholder="Enter Visa No" value="{{$visa_number}}">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input.
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-6">
                    <label style="font-weight:600">Visa Status</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select name="visa_status" id="visa_status" class="form-control form-select">
                            <option value="Pending" {{ (isset($visa_status) && $visa_status == "Pending")? "selected":"" }} >Pending</option>
                            <option value="Approved" {{ (isset($visa_status) && $visa_status == "Approved")? "selected":"" }} >Approved</option>
                            <option value="Denied" {{ (isset($visa_status) && $visa_status == "Denied")? "selected":"" }} >Denied</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-6">
                    <label style="font-weight:600">Date Receive</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="visa_date_received" name="visa_date_received" class="form-control datepicker" value="{{ $visa_date_received }}" placeholder="Select date">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input.
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-6">
                    <label style="font-weight:600">Date Expire</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="visa_date_expired" name="visa_date_expired" class="form-control datepicker" value="{{ $visa_date_expired }}" placeholder="Select date">
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
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Visa ER Cancel?</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select name="visa_er_iscancel" id="visa_er_iscancel" class="form-control form-select">
                            <option value="No" {{ (isset($visa_er_iscancel) && $visa_er_iscancel == "No")? "selected":"" }} >No</option>
                            <option value="Yes" {{ (isset($visa_er_iscancel) && $visa_er_iscancel == "Yes")? "selected":"" }} >Yes</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Visa MAID Cancel?</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select name="visa_maid_iscancel" id="visa_maid_iscancel" class="form-control form-select">
                            <option value="No" {{ (isset($visa_maid_iscancel) && $visa_maid_iscancel == "No")? "selected":"" }} >No</option>
                            <option value="Yes" {{ (isset($visa_maid_iscancel) && $visa_maid_iscancel == "Yes")? "selected":"" }} >Yes</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">VISA</label>
                    <div class="input-group custom-file-button">
                        <label class="input-group-text" for="visa"><i class="bi bi-file-earmark-text"></i>&nbsp;&nbsp;{{($visa != "")? "Replace":"Upload"}} Passport</label>
                        <input type="file" class="form-control form-control-sm" id="visa" name="visa">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    @if ($visa != "")
                    <label style="font-weight:600">Current VISA</label>
                    <div class="input-group">
                        <a class="btn btn-info text-white" target="_blank" href="{{  Storage::disk('s3')->url($visa)}}"><i class="bi bi-eye"></i> View</a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-6">
                    <label style="font-weight:600">Date Reactive</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="visa_reactive_date" name="visa_reactive_date" class="form-control datepicker" value="{{ $visa_reactive_date }}" placeholder="Select date">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-secondary mb-3 mt-4">
        <div class="card-header" style="font-size: 23px;background: #0d6cf9;color: white;">Job Order</div>
        <div class="card-body text-secondary">
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Job Order Receive</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                            <input type="text" id="jo_received" name="jo_received" class="form-control datepicker" value="{{ $jo_received }}" placeholder="Select date">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label style="font-weight:600">Job Order Confirm</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                            <input type="text" id="jo_confirmed" name="jo_confirmed" class="form-control datepicker" value="{{ $jo_confirmed }}" placeholder="Select date">
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
                        <label style="font-weight:600">Job Order Cancel?</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-option"></i></div>
                            <select name="jo_er_iscancel" id="jo_er_iscancel" class="form-control form-select">
                                <option value="Yes" {{ (isset($jo_er_iscancel) && $jo_er_iscancel == "Yes")? "selected":"" }} >Yes</option>
                                <option value="No" {{ (isset($jo_er_iscancel) && $jo_er_iscancel == "No")? "selected":"" }} >No</option>
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
                        <label style="font-weight:600">Job Order Maid Cancel?</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-option"></i></div>
                            <select name="jo_maid_iscancel" id="jo_maid_iscancel" class="form-control form-select">
                                <option value="Yes" {{ (isset($jo_maid_iscancel) && $jo_maid_iscancel == "Yes")? "selected":"" }} >Yes</option>
                                <option value="No" {{ (isset($jo_maid_iscancel) && $jo_maid_iscancel == "No")? "selected":"" }} >No</option>
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
        <div class="card-header" style="font-size: 23px;background: #0d6cf9;color: white;">(PDOS) Pre-departure Orientation Seminar</div>
        <div class="card-body text-secondary">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Date of Seminar</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="cert_pdos_date" name="cert_pdos_date" class="form-control datepicker" value="{{ $cert_pdos_date }}" placeholder="Select date">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input.
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Date of Release</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="cert_pdos_release_date" name="cert_pdos_release_date" class="form-control datepicker" value="{{ $cert_pdos_release_date }}" placeholder="Select date">
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
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Is Done?</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select name="cert_pdos_done" id="cert_pdos_done" class="form-control form-select">
                            <option value="Yes" {{ (isset($cert_pdos_done) && $cert_pdos_done == "Yes")? "selected":"" }} >Yes</option>
                            <option value="No" {{ (isset($cert_pdos_done) && $cert_pdos_done == "No")? "selected":"" }} >No</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Date Done</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="cert_pdos_date_done" name="cert_pdos_date_done" class="form-control datepicker" value="{{ $cert_pdos_date_done }}" placeholder="Select date">
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
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Cost</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-receipt"></i></div>
                        <input type="number" id="cert_pdos_cost" name="cert_pdos_cost" class="form-control" placeholder="Enter Training Cost" value="{{$cert_pdos_cost}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Certificate</label>
                    <div class="input-group custom-file-button">
                        <label class="input-group-text" for="cert_pdos"><i class="bi bi-file-earmark-text"></i>&nbsp;&nbsp;{{($cert_pdos != "")? "Replace":"Upload"}} Certificate</label>
                        <input type="file" class="form-control form-control-sm" id="cert_pdos" name="cert_pdos">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    @if ($cert_pdos != "")
                    <label style="font-weight:600">Current Certificate Document</label>
                    <div class="input-group">
                        <a class="btn btn-info text-white" target="_blank" href="{{  Storage::disk('s3')->url($cert_pdos)}}"><i class="bi bi-eye"></i> View</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card border-secondary mb-3 mt-4">
        <div class="card-header" style="font-size: 23px;background: #0d6cf9;color: white;">(OWWA) Overseas Workers Welfare Administration</div>
        <div class="card-body text-secondary">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Date of Seminar</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="cert_owwa_date" name="cert_owwa_date" class="form-control datepicker" value="{{ $cert_owwa_date }}" placeholder="Select date">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input.
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Date of Release</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="cert_owwa_release_date" name="cert_owwa_release_date" class="form-control datepicker" value="{{ $cert_owwa_release_date }}" placeholder="Select date">
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
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Certificate</label>
                    <div class="input-group custom-file-button">
                        <label class="input-group-text" for="cert_owwa"><i class="bi bi-file-earmark-text"></i>&nbsp;&nbsp;{{($cert_owwa != "")? "Replace":"Upload"}} Certificate</label>
                        <input type="file" class="form-control form-control-sm" id="cert_owwa" name="cert_owwa">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    @if ($cert_owwa != "")
                    <label style="font-weight:600">Current Certificate Document</label>
                    <div class="input-group">
                        <a class="btn btn-info text-white" target="_blank" href="{{  Storage::disk('s3')->url($cert_owwa)}}"><i class="bi bi-eye"></i> View</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card border-secondary mb-3 mt-4">
        <div class="card-header" style="font-size: 23px;background: #0d6cf9;color: white;">(NCII) Training</div>
        <div class="card-body text-secondary">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Date Enrolled</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="cert_nc2_date" name="cert_nc2_date" class="form-control datepicker" value="{{ $cert_nc2_date }}" placeholder="Select date">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input.
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">By Applicant?</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select name="cert_nc2_by_applicant" id="cert_nc2_by_applicant" class="form-control form-select">
                            <option value="Yes" {{ (isset($cert_nc2_by_applicant) && $cert_nc2_by_applicant == "Yes")? "selected":"" }} >Yes</option>
                            <option value="No" {{ (isset($cert_nc2_by_applicant) && $cert_nc2_by_applicant == "No")? "selected":"" }} >No</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Payment</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select name="cert_nc2_payment_status" id="cert_nc2_payment_status" class="form-control form-select">
                            <option value="Full" {{ (isset($cert_nc2_payment_status) && $cert_nc2_payment_status == "Full")? "selected":"" }} >Full Payment</option>
                            <option value="Partial" {{ (isset($cert_nc2_payment_status) && $cert_nc2_payment_status == "Partial")? "selected":"" }} >Partial Payment</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Cost</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-receipt"></i></div>
                        <input type="number" id="cert_nc2_cost" name="cert_nc2_cost" class="form-control" placeholder="Enter Training Cost" value="{{$cert_nc2_cost}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Is Done?</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select name="cert_nc2_done" id="cert_nc2_done" class="form-control form-select">
                            <option value="Yes" {{ (isset($cert_nc2_done) && $cert_nc2_done == "Yes")? "selected":"" }} >Yes</option>
                            <option value="No" {{ (isset($cert_nc2_done) && $cert_nc2_done == "No")? "selected":"" }} >No</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Date Done</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-calendar-date"></i></div>
                        <input type="text" id="cert_nc2_date_done" name="cert_nc2_date_done" class="form-control datepicker" value="{{ $cert_nc2_date_done }}" placeholder="Select date">
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
                <div class="col-lg-6 col-sm-12">
                    <label style="font-weight:600">Training Certificate</label>
                    <div class="input-group custom-file-button">
                        <label class="input-group-text" for="cert_nc2"><i class="bi bi-file-earmark-text"></i>&nbsp;&nbsp;{{($cert_nc2 != "")? "Replace":"Upload"}} Certificate</label>
                        <input type="file" class="form-control form-control-sm" id="cert_nc2" name="cert_nc2">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    @if ($cert_nc2 != "")
                    <label style="font-weight:600">Current Certificate Document</label>
                    <div class="input-group">
                        <a class="btn btn-info text-white" target="_blank" href="{{  Storage::disk('s3')->url($cert_nc2)}}"><i class="bi bi-eye"></i> View</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script>

    $(document).ready(function () {
        
        passportchopList();
        
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
        
        $('.form-select').select2({
            theme: 'bootstrap-5'
        });
    });
    
    $("input[type=text], input[type=file], input[type=number], textarea, select").on("change", function(){
        
        if ($(this).val()) {
            @if (!in_array("802", $editAccess))
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


    function passportchopList(page = 1){
        $.ajax({
            type: "POST",
            url: "{{ url('passport/table')}}",
            data: {applicant_id:$("#uid").val(), page:page},
            async: false,
            success:function(response){
                $("#passportchopTable").html(response);
            }
        });
    }

    $(".addbtnPassport").click(function() {
        var uid = "add";
        $.ajax({
            type: "POST",
            url: "{{ url('passport/getModal')}}",
            data: {
                uid: uid
            },
            success: function(response) {
                $("#modal-view").modal('toggle');
                $("#modal-view").find(".modal-title").text("Add Passport Chop");
                $("#modal-view").find("#modal-display").html(response);
            }
        });
    });

    $("#passportchopTable").on("click", ".editbtn", function() {
        var uid = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: "{{ url('passport/getModal')}}",
            data: {
                uid: uid
            },
            success: function(response) {
                $("#modal-view").modal('toggle');
                $("#modal-view").find(".modal-title").text("Edit Passport Chops");
                $("#modal-view").find("#modal-display").html(response);
            }
        });
    });

    $("#passportchopTable").on("click", ".delbtn", function() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, proceed!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {

                var code = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url: "{{ url('passport/delete')}}",
                    dataType: 'json',
                    data: {
                        code: code,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: response.title,
                                text: response.msg,
                                timer: 2500
                            })

                            passportchopList();
                        }else if (response.status == 2) {
                            Swal.fire({
                                icon: 'info',
                                title: response.title,
                                text: response.msg
                            })
                        }else if (response.status == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: response.title,
                                text: response.msg
                            })
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: "System Error",
                                text: "Please contact developer."
                            })
                        }
                    }
                });

            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Data is safe.',
                    'error'
                )
            }
        })
    });

    $(document).on("click","#paginationPassport a",function(){
        //get url and make final url for ajax 
        var url=$(this).attr("href");
        var mystr = url.split("=");
        passportchopList(mystr[1]);
        return false;
    })
</script>