<form id="principalForm" class="row g-2 needs-validation" novalidate>
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
        <label>Email<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-mailbox"></i></div>
            <input type="email" id="email" name="email"
            class="form-control validate" placeholder="Enter Email" required value="{{ (isset($email))? $email:"" }}">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a Email.
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <label>Job Site<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
            <select name="jobsite" id="jobsite" class="form-select validate">
                @foreach ($jobsite_select as $item)
                    <option value="{{$item->code}}" {{ (isset($jobsite) && $jobsite == $item->code)? "selected":"" }} >{{$item->description}}</option>
                @endforeach
            </select>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a Description.
            </div>
        </div>
    </div>
    
</form>

<script>
    
    $(document).ready(function () {
        $('#jobsite').select2({
            dropdownParent: $('#modal-view'),
            theme: 'bootstrap-5'
        });
    });
    $("#saveModal").unbind("click").click(function() {
        bootstrapForm($("#principalForm"));
        
        var formdata = $("#principalForm").serialize();

        swal.fire({
            html: '<h4>Loading...</h4>',
            didRender: function() {
                $('#swal2-html-container').prepend(sweet_loader);
            }
        });

        $.ajax({
            url: "{{ url('principal/add') }}",
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
                    PrincipalList();
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