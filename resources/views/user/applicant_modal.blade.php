<form id="applicantForm" class="row g-2 needs-validation" novalidate>
    @csrf

    <div class="col-md-6 col-sm-12">
        <label>Applicant ID<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
            <input type="text" id="applicant_id" name="applicant_id"
            class="form-control validate" placeholder="Enter Applicant ID" required value="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a Applicant ID.
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <label>First Name<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
            <input type="text" id="fname" name="fname"
            class="form-control validate" placeholder="Enter First Name" required value="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a First Name.
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <label>Middle Name<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
            <input type="text" id="mname" name="mname"
            class="form-control validate" placeholder="Enter Middle Name" required value="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a Middle Name.
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-sm-12">
        <label>Last Name<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
            <input type="text" id="lname" name="lname"
            class="form-control validate" placeholder="Enter Last Name" required value="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a Last Name.
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <label>Contact<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
            <input type="text" id="contact" name="contact"
            class="form-control validate" placeholder="Enter contact #" required value="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a contact #.
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <label>Branch<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-lines-fill"></i></div>
            <select name="branch" id="branch" class="form-select validate">
                @foreach ($branch_select as $item)
                    <option value="{{$item->code}}" {{ (isset(Auth::user()->branch) && Auth::user()->branch == $item->code)? "selected":"" }} >{{$item->description}}</option>
                @endforeach
            </select>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a branch.
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <label>Jobsite<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-lines-fill"></i></div>
            <select name="jobsite" id="jobsite" class="form-select validate">
                @foreach ($jobsite_select as $item)
                    <option value="{{$item->code}}">{{$item->description}}</option>
                @endforeach
            </select>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a jobsite.
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <label>Sales Manager<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-lines-fill"></i></div>
            <select name="sales_manager" id="sales_manager" class="form-select validate">
                @foreach ($users_select as $item)
                    <option value="{{$item->id}}" {{ (isset(Auth::user()->id) && Auth::user()->id == $item->id)? "selected":"" }}>{{$item->name}}</option>
                @endforeach
            </select>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a sales manager.
            </div>
        </div>
    </div>

</form>

<script>

    $(document).ready(function () {
        $('.form-select').select2({
            dropdownParent: $('#modal-view'),
            theme: 'bootstrap-5'
        });
    });

    $("#saveModal").unbind("click").click(function() {
        bootstrapForm($("#applicantForm"));
        
        var formdata = $("#applicantForm").serialize();
    
        swal.fire({
            html: '<h4>Loading...</h4>',
            didRender: function() {
                $('#swal2-html-container').prepend(sweet_loader);
            }
        });

        $.ajax({
            url: "{{ url('applicant/add') }}",
            type: "POST",
            data: formdata,
            dataType: 'json',
            success: function(response) {
                if (response.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: response.title,
                        text: response.msg,
                        time: 2500
                    })
                    $("#modalclose").click();
                    UserList();
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
    });
</script>