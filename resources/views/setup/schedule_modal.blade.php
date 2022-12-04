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
</form>

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
            @if (count($value) > 0)
            
            @foreach ($value as $item => $schedData)
            @php
            // dd($schedData);
            @endphp
            <tr tag='grp' dayofweek='{{$dcode}}'> 
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info" tag='copy_sched'><i class="bi bi-clipboard"></i>Copy</button>
                        <button type="button" class="btn btn-info" tag='paste_sched'><i class="bi bi-clipboard2-check"></i>Paste</button>
                        <button type="button" class="btn btn-info" tag='edit_erase_time'><i class="bi bi-clipboard2-x"></i>Erase</button>
                        <button type="button" class="btn btn-info" tag='add_sched'><i class="bi bi-clipboard2-plus"></i>Add</button>
                    </div>
                </td>
                <td>
                    {{$dow[$dcode]}}
                </td>
                <td>
                    <div class="input-group"> 
                        <input  type="text" class="form-control ftime" name="fromtime" value="{{ ($schedData->starttime)? date("g:i A",strtotime($schedData->starttime)):''}}"/> <span class="input-group-text" data-td-toggle="datetimepicker" > <i class="bi bi-calendar-fill"></i>
                        </span>
                    </div>
                </td>
                <td>
                    <div class="input-group"> 
                        <input  type="text" class="form-control totime" name="totime" value="{{ ($schedData->endtime)? date("g:i A",strtotime($schedData->endtime)):''}}"/> <span class="input-group-text" data-td-toggle="datetimepicker" > <i class="bi bi-calendar-fill"></i>
                        </span>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select class="subject-select subject select-predefined" name="subject" placeholder="Select Options" data-value="{{ ($schedData->subject)? $schedData->subject:''}}" data-url="{{ url('getDropdown/dropdownInit') }}" data-table="subject"> 
                            <option value="">Select Subject</option>
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
                    <input type="number" class="form-control units" name="units" min="0" max="5" value="{{ $schedData->units}}">
                </td>
                <td>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select class="prof-select prof select-predefined" name="professor" placeholder="Select Options" data-value="{{ ($schedData->professor)? $schedData->professor:''}}" data-url="{{ url('getDropdown/dropdownInit') }}" data-table="prof">
                            <option value="">Select Professor</option>
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
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select class="course-select course select-predefined" name="course" placeholder="Select Options" data-value="{{ ($schedData->coursecode)? $schedData->coursecode:''}}" data-url="{{ url('getDropdown/dropdownInit') }}" data-table="course">
                            <option value="">Select Course</option>
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
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select class="yearlevel-select yearlevel select-predefined" name="yearlevels" placeholder="Select Options" data-value="{{ ($schedData->yearlevels)? $schedData->yearlevels:''}}" data-url="{{ url('getDropdown/dropdownInit') }}" data-table="yl">
                            <option value="">Select Year Level</option>
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
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select class="section-select section select-predefined" name="section"  placeholder="Select Options" data-value="{{ ($schedData->section)? $schedData->section:''}}" data-url="{{ url('getDropdown/dropdownInit') }}" data-table="section">
                            <option value="">Select Section</option>
                        </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input.
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
            @else
            <tr tag='grp' dayofweek='{{$dcode}}'> 
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info" tag='copy_sched'><i class="bi bi-clipboard"></i>Copy</button>
                        <button type="button" class="btn btn-info" tag='paste_sched'><i class="bi bi-clipboard2-check"></i>Paste</button>
                        <button type="button" class="btn btn-info" tag='edit_erase_time'><i class="bi bi-clipboard2-x"></i>Erase</button>
                        <button type="button" class="btn btn-info" tag='add_sched'><i class="bi bi-clipboard2-plus"></i>Add</button>
                    </div>
                </td>
                <td>
                    {{$dow[$dcode]}}
                </td>
                <td>
                    <div class="input-group"> 
                        <input  type="text" class="form-control ftime" name="fromtime"/> <span class="input-group-text" data-td-toggle="datetimepicker" > <i class="bi bi-calendar-fill"></i>
                        </span>
                    </div>
                </td>
                <td>
                    <div class="input-group"> 
                        <input  type="text" class="form-control totime" name="totime" /> <span class="input-group-text" data-td-toggle="datetimepicker" > <i class="bi bi-calendar-fill"></i>
                        </span>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select class="subject-select subject" name="subject" placeholder="Select Options" subjectSelect="">
                            <option value="">Select Subject</option>
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
                    <input type="number" class="form-control units" name="units" min="0" max="5" value="">
                </td>
                <td>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select class="prof-select prof" name="professor" placeholder="Select Options">
                            <option value="">Select Professor</option>
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
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select class="course-select course" name="course" placeholder="Select Options">
                            <option value="">Select Course</option>
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
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select class="yearlevel-select yearlevel" name="yearlevels" placeholder="Select Options">
                            <option value="">Select Year Level</option>
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
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-option"></i></div>
                        <select class="section-select section" name="section"  placeholder="Select Options">
                            <option value="">Select Section</option>
                        </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input.
                        </div>
                    </div>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>

<script>
    
    var schedarr = [];
    
    $(document).ready(function () {
        
        $('.select-predefined').each(function (index, element) {
            var item = $(element);
            if (item.data('url')) {
                CustomInitSelect2(item, {
                    url: item.data('url'),
                    table: item.data('table'),
                    desc: item.data('desc'),
                    initialValue: item.data('value')
                });
            }
        });
        
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
                                units: item.units,
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
                placeholder: 'Search Professor',
                allowClear: true,
                type : "POST",
                data:function (params) {
                    var query = {
                        search: params.term,
                        dataSearch:"prof",
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
        
        $('.course-select').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#modal-view'),
            ajax: {
                placeholder: 'Search Course',
                allowClear: true,
                type : "POST",
                data:function (params) {
                    var query = {
                        search: params.term,
                        dataSearch:"course",
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
        
        $('.yearlevel-select').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#modal-view'),
            ajax: {
                placeholder: 'Search Year Level',
                allowClear: true,
                type : "POST",
                data:function (params) {
                    var query = {
                        search: params.term,
                        dataSearch:"yl",
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
        
        $('.section-select').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#modal-view'),
            ajax: {
                placeholder: 'Search Section',
                allowClear: true,
                type : "POST",
                data:function (params) {
                    var query = {
                        search: params.term,
                        dataSearch:"section",
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
    
    function CustomInitSelect2(element, options) {
        if (options.url) {
            $.ajax({
                type: 'POST',
                url: options.url,
                data:{id:options.initialValue, desc:options.table},
                dataType: 'json'
            }).then(function (data) {
                console.log(data);
                var option = new Option(data.desc, data.id, true, true);
                element.append(option).trigger('change');
            });
        }
    }


    $('.subject-select').change(function() {
        console.log();
        var units = $(this).select2('data')[0].units;
        $(this).parent().parent().parent().find(".units").val(units);
    });
    
    
    $("#saveModal").unbind().bind("click").click(function(){
        
        swal.fire({
            html: '<h4>Loading...</h4>',
            didRender: function() {
                $('#swal2-html-container').prepend(sweet_loader);
            }
        });
        
        
        var hasconflict = 0;
        var last_trcode = "";
        $("#schedule").find("tr[tag='grp']").each(function(){
            var ftime = $(this).find("input[name='fromtime']:first").val();
            var totime = $(this).find("input[name='totime']:first").val();
            var tardy_f = $(this).find("input[name='tardy_f']:first").val();
            var absent_f = $(this).find("input[name='absent_f']:first").val();
            var early_d = $(this).find("input[name='early_d']:first").val();
            if(last_trcode != $(this).attr("dayofweek")){
                if(ftime == totime && ftime && totime){
                    hasconflict++;
                }
            }
            var last_trcode = $(this).attr("dayofweek");
        });
        
        if(hasconflict>0){
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Invalid Schedule',
                showConfirmButton: true,
                timer: 1000
            });
            return;
        } 
        
        bootstrapForm($("#sectionForm"));
        
        var formdata = $("#sectionForm").serialize();
        
        
        var pars2 = "~u~"; 
        var scheduleData = "";
        var timediff = 0;
        $("#schedule").find("tr[tag='grp']").each(function(){
            if($(this).find("input[name='fromtime']:first").val() && $(this).find("input[name='totime']:first").val()){
                scheduleData += scheduleData ? "|" : ""; 
                scheduleData += $(this).attr("dayofweek");
                scheduleData += pars2;
                scheduleData += $(this).find("input[name='fromtime']:first").val() + "-" + $(this).find("input[name='totime']:first").val();
                scheduleData += pars2;
                scheduleData += $(this).find("select[name='subject']:first").val();
                scheduleData += pars2;
                scheduleData += $(this).find("input[name='units']:first").val();
                scheduleData += pars2;
                scheduleData += $(this).find("select[name='professor']:first").val();
                scheduleData += pars2;
                scheduleData += $(this).find("select[name='course']:first").val();
                scheduleData += pars2;
                scheduleData += $(this).find("select[name='yearlevels']:first").val();
                scheduleData += pars2;
                scheduleData += $(this).find("select[name='section']:first").val();
            }
        });
        
        formdata+="&schedule=" + scheduleData; 
        
        $.ajax({
            url: "{{ url('schedule/add') }}",
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
                    ScheduleList();
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
    
    $("button[tag='copy_sched']").click(function(){  copytime($(this).parent().parent().parent());
        $("button[tag='copy_sched']").each(function(){   $(this).css({"color":"","background-color":""});});
    });
    
    $("button[tag='paste_sched']").click(function(){ pastetime($(this).parent().parent().parent()); });
    
    function copytime(obj){
        if(schedarr.length > 0)  schedarr = [];
        var schedarr_temp = [];
        $('tr[dayofweek='+obj.attr('dayofweek')+']').each(function(){
            var from          = $(this).find("input[name='fromtime']").val();
            var to            = $(this).find("input[name='totime']").val();
            var subject           = $(this).find("select[name='subject']").val();
            var subjectOption           = $(this).find("select[name='subject']").find('option').clone();
            var unit           = $(this).find("input[name='units']").val();
            var professor           = $(this).find("select[name='professor']").val();
            var professorOption           = $(this).find("select[name='professor']").find('option').clone();
            var course           = $(this).find("select[name='course']").val();
            var courseOption           = $(this).find("select[name='course']").find('option').clone();
            var yearlevels           = $(this).find("select[name='yearlevels']").val();
            var yearlevelsOption           = $(this).find("select[name='yearlevels']").find('option').clone();
            var section           = $(this).find("select[name='section']").val();
            var sectionOption           = $(this).find("select[name='section']").find('option').clone();
            
            if(from != '' || to != '' || subject != '' || unit != '' || professor != '' || course != ''|| yearlevels != ''|| section != ''){
                schedarr_temp = {
                    'fromtime'  :from,
                    'totime'    :to,
                    'subject' :subject,
                    'subjectOption' :subjectOption,
                    'unit'   :unit,
                    'professor'  :professor,
                    'professorOption' :professorOption,
                    'course'   :course,
                    'courseOption' :courseOption,
                    'yearlevels'   :yearlevels,
                    'yearlevelsOption' :yearlevelsOption,
                    'section'   :section,
                    'sectionOption' :sectionOption,
                };
                schedarr.push(schedarr_temp);
            }
        });
    }
    
    function pastetime(obj){
        var schedarr_orig       = [],
        schedarr_orig_temp  = [];
        $('tr[dayofweek='+obj.attr('dayofweek')+']').each(function(){
            var from          = $(this).find("input[name='fromtime']").val();
            var to            = $(this).find("input[name='totime']").val();
            var subject           = $(this).find("select[name='subject']").val();
            var subjectOption           = $(this).find("select[name='subject']").find('option').clone();
            var unit           = $(this).find("input[name='units']").val();
            var professor           = $(this).find("select[name='professor']").val();
            var professorOption           = $(this).find("select[name='professor']").find('option').clone();
            var course           = $(this).find("select[name='course']").val();
            var courseOption           = $(this).find("select[name='course']").find('option').clone();
            var yearlevels           = $(this).find("select[name='yearlevels']").val();
            var yearlevelsOption           = $(this).find("select[name='yearlevels']").find('option').clone();
            var section           = $(this).find("select[name='section']").val();
            var sectionOption           = $(this).find("select[name='section']").find('option').clone();
            
            if(from != '' || to != '' || subject != '' || unit != '' || professor != '' || course != ''|| yearlevels != ''|| section != ''){
                schedarr_orig_temp = {
                    'fromtime'  :from,
                    'totime'    :to,
                    'subject' :subject,
                    'subjectOption' :subjectOption,
                    'unit'   :unit,
                    'professor'  :professor,
                    'professorOption' :professorOption,
                    'course'   :course,
                    'courseOption' :courseOption,
                    'yearlevels'   :yearlevels,
                    'yearlevelsOption' :yearlevelsOption,
                    'section'   :section,
                    'sectionOption' :sectionOption,
                };
                schedarr_orig.push(schedarr_orig_temp);
            }
            $(this).find("button[tag=delete_sched]").click();
        });
        if(schedarr_orig.length == 0){
            if(schedarr.length > 0){
                obj.find("input[name='fromtime']").val(schedarr[0]['fromtime']);
                obj.find("input[name='totime']").val(schedarr[0]['totime']);
                obj.find("select[name='subject']").append(schedarr[0]['subjectOption']).val(schedarr[0]['subject']).trigger('change');
                obj.find("input[name='units']").val(schedarr[0]['unit']);
                obj.find("select[name='professor']").append(schedarr[0]['professorOption']).val(schedarr[0]['professor']).trigger('change');
                obj.find("select[name='course']").append(schedarr[0]['courseOption']).val(schedarr[0]['course']).trigger('change');
                obj.find("select[name='yearlevels']").append(schedarr[0]['yearlevelsOption']).val(schedarr[0]['yearlevels']).trigger('change');
                obj.find("select[name='section']").append(schedarr[0]['sectionOption']).val(schedarr[0]['section']).trigger('change');
                
                if(schedarr.length > 1){
                    for (var i = schedarr.length - 1; i >= 1; i--) {
                        console.log(obj);
                        $(obj).find("button[tag=add_sched]").click();
                        $(obj).next(':first').find("input[name='fromtime']").val(schedarr[i]['fromtime']);
                        $(obj).next(':first').find("input[name='totime']").val(schedarr[i]['totime']);
                        $(obj).next(':first').find("select[name='subject']").append(schedarr[i]['subjectOption']).val(schedarr[i]['subject']).trigger('change');
                        $(obj).next(':first').find("input[name='units']").val(schedarr[i]['units']);
                        $(obj).next(':first').find("select[name='professor']").append(schedarr[i]['professorOption']).val(schedarr[i]['professor']).trigger('change');
                        $(obj).next(':first').find("select[name='course']").append(schedarr[i]['courseOption']).val(schedarr[i]['course']).trigger('change');
                        $(obj).next(':first').find("select[name='yearlevels']").append(schedarr[i]['yearlevelsOption']).val(schedarr[i]['yearlevels']).trigger('change');
                        $(obj).next(':first').find("select[name='section']").append(schedarr[i]['sectionOption']).val(schedarr[i]['section']).trigger('change');
                    }
                }
            }
        }else if(schedarr_orig.length > 0){
            if(schedarr.length > 0){
                for (var i = schedarr.length - 1; i >= 0; i--) {
                    $(obj).find("button[tag=add_sched]").click();
                    $(obj).next(':first').find("input[name='fromtime']").val(schedarr[i]['fromtime']);
                    $(obj).next(':first').find("input[name='totime']").val(schedarr[i]['totime']);
                    $(obj).next(':first').find("select[name='subject']").append(schedarr[i]['subjectOption']).val(schedarr[i]['subject']).trigger('change');
                    $(obj).next(':first').find("input[name='units']").val(schedarr[i]['units']);
                    $(obj).next(':first').find("select[name='professor']").append(schedarr[i]['professorOption']).val(schedarr[i]['professor']).trigger('change');
                    $(obj).next(':first').find("select[name='course']").append(schedarr[i]['courseOption']).val(schedarr[i]['course']).trigger('change');
                    $(obj).next(':first').find("select[name='yearlevels']").append(schedarr[i]['yearlevelsOption']).val(schedarr[i]['yearlevels']).trigger('change');
                    $(obj).next(':first').find("select[name='section']").append(schedarr[i]['sectionOption']).val(schedarr[i]['section']).trigger('change');
                }
            }
        }
        
        if(schedarr_orig.length == 1){
            obj.find("input[name='fromtime']").val(schedarr_orig[0]['fromtime']);
            obj.find("input[name='totime']").val(schedarr_orig[0]['totime']);
            obj.find("select[name='subject']").append(schedarr_orig[0]['subjectOption']).val(schedarr_orig[0]['subject']).trigger('change');
            obj.find("input[name='units']").val(schedarr_orig[0]['unit']);
            obj.find("select[name='professor']").append(schedarr_orig[0]['professorOption']).val(schedarr_orig[0]['professor']).trigger('change');
            obj.find("select[name='course']").append(schedarr_orig[0]['courseOption']).val(schedarr_orig[0]['course']).trigger('change');
            obj.find("select[name='yearlevels']").append(schedarr_orig[0]['yearlevelsOption']).val(schedarr_orig[0]['yearlevels']).trigger('change');
            obj.find("select[name='section']").append(schedarr_orig[0]['sectionOption']).val(schedarr_orig[0]['section']).trigger('change');
        }
        
        if(schedarr_orig.length > 1){
            for (var i = schedarr_orig.length - 1; i > 0; i--) {
                $(obj).find("button[tag=add_sched]").click();
                $(obj).next(':first').find("input[name='fromtime']").val(schedarr_orig[i]['fromtime']);
                $(obj).next(':first').find("input[name='totime']").val(schedarr_orig[i]['totime']);
                $(obj).next(':first').find("select[name='subject']").append(schedarr_orig[i]['subjectOption']).val(schedarr_orig[i]['subject']).trigger('change');
                $(obj).next(':first').find("input[name='units']").val(schedarr_orig[i]['units']);
                $(obj).next(':first').find("select[name='professor']").append(schedarr_orig[i]['professorOption']).val(schedarr_orig[i]['professor']).trigger('change');
                $(obj).next(':first').find("select[name='course']").append(schedarr_orig[i]['courseOption']).val(schedarr_orig[i]['course']).trigger('change');
                $(obj).next(':first').find("select[name='yearlevels']").append(schedarr_orig[i]['yearlevelsOption']).val(schedarr_orig[i]['yearlevels']).trigger('change');
                $(obj).next(':first').find("select[name='section']").append(schedarr_orig[i]['sectionOption']).val(schedarr_orig[i]['section']).trigger('change');
            }
        }
        
        copytime(obj);
    }
    
    $("button[tag='edit_erase_time']").click(function(){
        var tr_id = $(this).closest("tr").attr("dayofweek");
        $("tr[dayofweek='"+ tr_id +"']").find(".ftime").val('');
        $("tr[dayofweek='"+ tr_id +"']").find(".totime").val('');
        $("tr[dayofweek='"+ tr_id +"']").find(".subject").val('').trigger('change');
        $("tr[dayofweek='"+ tr_id +"']").find(".prof").val('').trigger('change');
        $("tr[dayofweek='"+ tr_id +"']").find(".course").val('').trigger('change');
        $("tr[dayofweek='"+ tr_id +"']").find(".yearlevel").val('').trigger('change');
        $("tr[dayofweek='"+ tr_id +"']").find(".section").val('').trigger('change');
    });
    
    $("button[tag='delete_sched']").click(function(){
        var obj = $(this).parent().parent().parent().remove();  
    });
    
    $("button[tag='add_sched']").click(function(){
        var obj = $(this).parent().parent().parent().clone(true);
        
        var delete_button = $('<button type="button" class="btn btn-info" tag="delete_sched"><i class="bi bi-clipboard2-x"></i>Remove</button>').click(function(){
            $(this).parent().parent().parent().remove();  
        });
        var timefrom_picker = $('<div class="input-group"><input  type="text" class="form-control ftime" name="fromtime"/> <span class="input-group-text" data-td-toggle="datetimepicker" > <i class="bi bi-calendar-fill"></i></span></div>');
        var timeto_picker = $('<div class="input-group"><input  type="text" class="form-control totime" name="totime"/> <span class="input-group-text" data-td-toggle="datetimepicker" > <i class="bi bi-calendar-fill"></i></span></div>');
        
        var subject_drop       = $('<div class="input-group"><div class="input-group-text"><i class="bi bi-option"></i></div><select class="subject-select subject" name="subject" placeholder="Select Options"><option value="">Select Subject</option> </select> <div class="valid-feedback">Looks good! </div> <div class="invalid-feedback">Please input. </div></div>');
        
        var prof_drop       = $('<div class="input-group"><div class="input-group-text"><i class="bi bi-option"></i></div><select class="prof-select prof" name="professor" placeholder="Select Options"><option value="">Select Professor</option> </select> <div class="valid-feedback">Looks good! </div> <div class="invalid-feedback">Please input. </div></div>');
        
        var course_drop       = $('<div class="input-group"><div class="input-group-text"><i class="bi bi-option"></i></div><select class="course-select course" name="course" placeholder="Select Options"><option value="">Select Course</option> </select> <div class="valid-feedback">Looks good! </div> <div class="invalid-feedback">Please input. </div></div>');
        
        var yl_drop       = $('<div class="input-group"><div class="input-group-text"><i class="bi bi-option"></i></div><select class="yearlevel-select yearlevel" name="yearlevels" placeholder="Select Options"><option value="">Select Year Level</option> </select> <div class="valid-feedback">Looks good! </div> <div class="invalid-feedback">Please input. </div></div>');
        
        var section_drop       = $('<div class="input-group"><div class="input-group-text"><i class="bi bi-option"></i></div><select class="section-select section" name="section" placeholder="Select Options"><option value="">Select Section</option> </select> <div class="valid-feedback">Looks good! </div> <div class="invalid-feedback">Please input. </div></div>');
        
        
        $(obj).find("td:first").find("div:first").html("");
        $(obj).find("td:eq(0)").find("div:first").html($(delete_button));
        $(obj).find("td:eq(1)").find("div:first").html(""); 
        
        $(obj).find("td:eq(2)").find("div:first").html(""); 
        $(obj).find("td:eq(2)").find("div:first").append($(timefrom_picker)); 
        
        $(obj).find("td:eq(3)").find("div:first").html(""); 
        $(obj).find("td:eq(3)").find("div:first").append($(timeto_picker));
        
        $(obj).find("td:eq(4)").find("div:first").html(""); 
        $(obj).find("td:eq(4)").find("div:first").append($(subject_drop));
        
        $(obj).find("td:eq(6)").find("div:first").html(""); 
        $(obj).find("td:eq(6)").find("div:first").append($(prof_drop));
        
        $(obj).find("td:eq(7)").find("div:first").html(""); 
        $(obj).find("td:eq(7)").find("div:first").append($(course_drop));
        
        $(obj).find("td:eq(8)").find("div:first").html(""); 
        $(obj).find("td:eq(8)").find("div:first").append($(yl_drop));
        
        $(obj).find("td:eq(9)").find("div:first").html(""); 
        $(obj).find("td:eq(9)").find("div:first").append($(section_drop));
        
        $(obj).find("input[name='fromtime'],input[name='totime']").tempusDominus({
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
        
        $(obj).find(".subject-select").select2({
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
                                units: item.units,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
        
        $(obj).find(".prof-select").select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#modal-view'),
            ajax: {
                placeholder: 'Search Professor',
                allowClear: true,
                type : "POST",
                data:function (params) {
                    var query = {
                        search: params.term,
                        dataSearch:"prof",
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
        
        $(obj).find(".course-select").select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#modal-view'),
            ajax: {
                placeholder: 'Search Course',
                allowClear: true,
                type : "POST",
                data:function (params) {
                    var query = {
                        search: params.term,
                        dataSearch:"course",
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
        
        $(obj).find(".yearlevel-select").select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#modal-view'),
            ajax: {
                placeholder: 'Search Year Level',
                allowClear: true,
                type : "POST",
                data:function (params) {
                    var query = {
                        search: params.term,
                        dataSearch:"yl",
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
        
        $(obj).find(".section-select").select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#modal-view'),
            ajax: {
                placeholder: 'Search Section',
                allowClear: true,
                type : "POST",
                data:function (params) {
                    var query = {
                        search: params.term,
                        dataSearch:"section",
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
        
        $(obj).find('.subject-select').change(function() {
            var units = $(this).select2('data')[0].units;
            $(this).parent().parent().parent().parent().find(".units").val(units);
        })
        
        $(obj).insertAfter($(this).parent().parent().parent());   
        $(obj).find("input[name='fromtime']").focus();
    });
    
    
</script>