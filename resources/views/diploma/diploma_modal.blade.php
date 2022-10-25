<form id="diplomaForm" class="row g-2 needs-validation" novalidate>
    @csrf
    <input type="hidden" name="uid" value="{{($uid)}}">

    <div class="col-md-6 col-sm-12">
        <label>Type<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-pencil-fill"></i></div>
            <select name="type" id="type" class="form-control form-select">
                <option value="College" {{ (isset($type) && $type == "College")? "selected":"" }} >College</option>
                <option value="High School" {{ (isset($type) && $type == "High School")? "selected":"" }} >High School</option>
            </select>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a Type.
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <label>Remarks<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-pencil-fill"></i></div>
            <input type="text" id="remarks" name="remarks"
            class="form-control validate" placeholder="Enter Remarks" required value="{{ (isset($remarks))? $remarks:"" }}">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a Remarks.
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <label>Diploma<span class="text-danger"></span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-image"></i></div>
            <input type="file" id="diploma" name="diploma" class="form-control validate" value="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a image JPG or PNG.
            </div>
        </div>
    </div>
    
</form>

<script>
    
    $("#saveModal").unbind("click").click(function() {

        $("<input type='hidden'/>")
                .attr("name", "applicant_id")
                .attr("value", $("#uid").val())
                .prependTo("#diplomaForm");


        bootstrapForm($("#diplomaForm"));
        
        var formdata = processForm($("#diplomaForm"));
    
        swal.fire({
            html: '<h4>Loading...</h4>',
            didRender: function() {
                $('#swal2-html-container').prepend(sweet_loader);
            }
        });

        $.ajax({
            url: "{{ url('diploma/add') }}",
            type: "POST",
            data: formdata,
            cache:false,
            contentType: false,
            processData: false,
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
                    diplomaList();
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