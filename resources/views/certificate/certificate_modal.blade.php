<form id="diplomaForm" class="row g-2 needs-validation" novalidate>
    @csrf
    <input type="hidden" name="uid" value="{{($uid)}}">

    <div class="col-md-12 col-sm-12">
        <label>Description<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-pencil-fill"></i></div>
            <input type="text" id="description" name="description"
            class="form-control validate" placeholder="Enter Description" required value="{{ (isset($description))? $description:"" }}">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a Description.
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <label>Certificate<span class="text-danger"></span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-image"></i></div>
            <input type="file" id="certificate" name="certificate" class="form-control validate" value="">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a image JPG, PNG or PDF.
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