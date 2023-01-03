<form id="eventForm" class="row g-2 needs-validation" novalidate>
    @csrf
    <input type="hidden" name="uid" value="{{($uid)}}">
    <div class="col-md-6 col-sm-12">
        <label>Title<span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-pencil-fill"></i></div>
            <input type="text" id="title" name="title"
            class="form-control validate" placeholder="Enter Title" required value="{{ (isset($title))? $title:"" }}" max="50">
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please input a Title.
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <label>Date<span class="text-danger">*</span></label>
        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" name="date" value="{{ ($date)? $date:''}}"/>
            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="bi bi-calendar-fill"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <label>From To<span class="text-danger">*</span></label>
        <div class="input-group"> 
            <input  type="text" class="form-control totime" name="time_start" value="{{ ($start)? date("h:i A",strtotime($start)):''}}"/> <span class="input-group-text" data-td-toggle="datetimepicker" > <i class="bi bi-calendar-fill"></i>
            </span>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <label>Title<span class="text-danger">*</span></label>
        <div class="input-group"> 
            <input  type="text" class="form-control totime" name="time_end" value="{{ ($end)? date("h:i A",strtotime($end)):''}}"/> <span class="input-group-text" data-td-toggle="datetimepicker" > <i class="bi bi-calendar-fill"></i>
            </span>
        </div>
    </div>
    
</form>
<script>
    
    $(document).ready(function () {
        $(".totime").tempusDominus({
            display: {
                viewMode: 'clock',
                components: {
                    decades: false,
                    year: false,
                    month: false,
                    date: false,
                    hours: true,
                    minutes: true,
                    seconds: false
                }
            }
        });

        $('#datetimepicker1').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
    
    $("#saveModal").unbind("click").click(function() {
        bootstrapForm($("#eventForm"));
        
        var formdata = processForm($("#eventForm"));

        swal.fire({
            html: '<h4>Loading...</h4>',
            didRender: function() {
                $('#swal2-html-container').prepend(sweet_loader);
            }
        });
        
        $.ajax({
            url: "{{ url('event/add') }}",
            type: "POST",
            data: formdata,
            processData: false,
            contentType: false,
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
                    location.reload();
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