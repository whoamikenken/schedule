@extends('layouts.header')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My Profile</h1>
</div>
<input type="hidden" id="studentUID" value="{{Auth::user()->username}}">
<div id="studentContainer">
</div>

<script>
    
    $(document).ready(function () {
        var uid = $("#studentUID").val();
        $.ajax({
            type: "POST",
            url: "{{ url('student/getStudentProfileTab')}}",
            data: {
                uid: uid
            },
            success: function(response) {
                $("#studentContainer").html(response);
            }
        });
    });
</script>
@endsection
