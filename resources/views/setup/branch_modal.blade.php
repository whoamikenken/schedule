<form id="branchForm" class="row g-2 needs-validation" novalidate>
    @csrf
    <input type="hidden" name="uid" value="{{($uid)}}">
    <div class="col-md-6 col-sm-12">
        <label>Code<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-pencil-fill"></i></div>
            <input type="text" id="code" name="code"
            class="form-control validate" placeholder="Enter Code" required value="{{ (isset($code))? $code:"" }}">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a Code.
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-sm-12">
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

    <div class="col-md-6 col-sm-12">
        <label>Region<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-geo-fill"></i></div>
            <select name="region" id="region" class="form-control form-select">
                <option value="Luzon" {{ (isset($region) && $region == "Luzon")? "selected":"" }} >Luzon</option>
                <option value="Visayas" {{ (isset($region) && $region == "Visayas")? "selected":"" }} >Visayas</option>
                <option value="Mindanaos" {{ (isset($region) && $region == "Mindanaos")? "selected":"" }} >Mindanaos</option>
            </select>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a Region.
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-sm-12">
        <label>Color<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-pencil-fill"></i></div>
            <input type="text" id="color" name="color"
            class="form-control validate" placeholder="Enter Color" required value="{{ (isset($color))? $color:"" }}">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a Color.
            </div>
        </div>
    </div>
    
</form>

<script>
    
    $("#saveModal").unbind("click").click(function() {
        bootstrapForm($("#branchForm"));
        
        var formdata = $("#branchForm").serialize();

        swal.fire({
            html: '<h4>Loading...</h4>',
            didRender: function() {
                $('#swal2-html-container').prepend(sweet_loader);
            }
        });

        $.ajax({
            url: "{{ url('branch/add') }}",
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
                    BranchList();
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