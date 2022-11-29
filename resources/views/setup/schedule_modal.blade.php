<form id="sectionForm" class="row g-2 needs-validation" novalidate>
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
    
    <hr class="mt-2 md-2">
    <h3 class="text-center">Schedule</h3>
    
    <div class="container-fluid">
        <table class="table ">
            <thead style="background-color: #FFF201;">
                <tr>
                    <th>Actions</th>
                    <th>Day of Week</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Subject</th>
                    <th>Units</th>
                    <th>Professor</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Section</th>
                </tr>
            </thead>
            <tbody id="schedule">
                @foreach ($sched_per_day as $dcode => $value)
                @if (count($value) > 1)
                
                @else
                <tr tag='grp' dayofweek='{{$dcode}}'> 
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-info"><i class="bi bi-clipboard"></i>Copy</button>
                            <button type="button" class="btn btn-info"><i class="bi bi-clipboard2-check"></i>Paste</button>
                            <button type="button" class="btn btn-info"><i class="bi bi-clipboard2-x"></i>Remove</button>
                            <button type="button" class="btn btn-info"><i class="bi bi-clipboard2-plus"></i>Add</button>
                        </div>
                    </td>
                    <td>
                        {{$dow[$dcode]}}
                    </td>
                    <td>
                        <div class="input-group"> 
                            <input  type="text" class="form-control ftime" /> <span class="input-group-text" data-td-toggle="datetimepicker" > <i class="bi bi-calendar-fill"></i>
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="input-group"> 
                            <input  type="text" class="form-control totime" /> <span class="input-group-text" data-td-toggle="datetimepicker" > <i class="bi bi-calendar-fill"></i>
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-option"></i></div>
                            <select class=" subject-select"  placeholder="Select Options">
                                 <option value="">Select Subject</option>
                                 {{--
                                @foreach ($subject_select as $item)
                                    <option value="{{$item->id}}">{{$item->course_desc}}</option>
                                @endforeach --}}
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please input.
                            </div>
                        </div>
                    </td>
                    <td>
                        <input type="number" class="form-control units" min="0" max="5" value="2.0">
                    </td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
    
</form>


<script>
    
    $(document).ready(function () {
        
        $('.subject-select').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#modal-view'),
            ajax: {
                placeholder: 'Search Subject',
                allowClear: true,
                type : "POST",
                data:function (params) {
                    var query = {
                        search: params.term,
                        dataSearch:"subject",
                        mode:"single",
                    }
                    return query;
                },
                async: false,
                url: "{{ url('getDropdown/dropdown') }}",
                dataType: 'json',
                delay: 500,
                minimumInputLength: 1,
                processResults: function (data) {
                    return {
                        results: $.map(data.items, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('.prof-select').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#modal-view'),
            ajax: {
                placeholder: 'Search Subject',
                allowClear: true,
                type : "POST",
                data:function (params) {
                    var query = {
                        search: params.term,
                        dataSearch:"subject",
                        mode:"single",
                    }
                    return query;
                },
                async: false,
                url: "{{ url('getDropdown/dropdown') }}",
                dataType: 'json',
                delay: 500,
                minimumInputLength: 1,
                processResults: function (data) {
                    return {
                        results: $.map(data.items, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
        
        $('.ftime, .totime').tempusDominus({
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
        
    
    });
    
    $("#saveModal").unbind("click").click(function() {
        bootstrapForm($("#sectionForm"));
        
        var formdata = $("#sectionForm").serialize();
        
        swal.fire({
            html: '<h4>Loading...</h4>',
            didRender: function() {
                $('#swal2-html-container').prepend(sweet_loader);
            }
        });
        
        $.ajax({
            url: "{{ url('section/add') }}",
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
                    SectionList();
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