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
        <label>Email<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
            <input type="email" id="email" name="email"
            class="form-control validate" placeholder="Enter Email" required value="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a Email.
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <label>Address<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
            <input type="text" id="address" name="address"
            class="form-control validate" placeholder="Enter Address" required value="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a Address.
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <label>Campus<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-lines-fill"></i></div>
            <select name="campus" id="campus" class="form-select-modal validate">
                @foreach ($campuses_select as $item)
                    <option value="{{$item->code}}" >{{$item->description}}</option>
                @endforeach
            </select>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a Campus.
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <label>Year Level<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-lines-fill"></i></div>
            <select name="year_level" id="year_level" class="form-select-modal validate">
                @foreach ($yearlevels_select as $item)
                    <option value="{{$item->code}}">{{$item->description}}</option>
                @endforeach
            </select>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a Course.
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <label>Course<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-lines-fill"></i></div>
            <select name="course" id="course" class="form-select-modal validate">
                @foreach ($courses_select as $item)
                    <option value="{{$item->code}}">{{$item->description}}</option>
                @endforeach
            </select>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a Course.
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <label>Section<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-lines-fill"></i></div>
            <select name="section" id="section" class="form-select-modal validate">
                @foreach ($sections_select as $item)
                    <option value="{{$item->code}}">{{$item->description}}</option>
                @endforeach
            </select>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a Section.
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <label>Adviser<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-lines-fill"></i></div>
            <select name="adviser" id="adviser" class="form-select-modal validate">
                @foreach ($users_select as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please select a adviser.
            </div>
        </div>
    </div>

    

</form>

<script>

    $(document).ready(function () {
        $('.form-select-modal').select2({
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
                    ApplicantList();
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