@extends('layouts.header')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Branch</h1>
</div>
<div class="card shadow animate__animated animate__fadeInRight">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a href="javascript:void(0);" class="btn btn-primary mb-2 addbtn"><i class="bi bi-plus-circle"></i> Add Branch</a>
            </div>
            <div class="col-sm-7">
                <div class="text-sm-end">
                    {{-- <button type="button" class="btn btn-secondary mb-2"><i class="bi bi-printer"></i> Print</button> --}}
                </div>
            </div><!-- end col-->
        </div>
        
        <div class="table-responsive">
            <table id="BranchTable" class="table table-hover table-responsive">
        </table>
        </div>
    </div> <!-- end card-body-->
</div>

<script>
    var logo;
    var tableObj = null;

    
    $(document).ready(function () {

        BranchList();

        var bar = getBase64FromUrl('{{asset("icon/ms-icon-150x150.png")}}');
        
        bar.then((result) => {
            logo = result;
            // do whatever you want to do with result
        }).catch(err=>console.log(err))
    });

    const getBase64FromUrl = async (url) => {
        const data = await fetch(url);
        const blob = await data.blob();
        return new Promise((resolve) => {
            const reader = new FileReader();
            reader.readAsDataURL(blob); 
            reader.onloadend = () => {
                const base64data = reader.result;   
                resolve(base64data);
            }
        });
    }

    function BranchList(){

        if(tableObj!=null){
            tableObj.destroy();
        }


        $.ajax({
            type: "POST",
            url: "{{ url('branch/table')}}",
            data: {},
            async: false,
            success:function(response){
                $("#BranchTable").html(response);
                tableObj = $("#BranchTable").DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                    {
                        extend: 'pdfHtml5',
                        text:'Export PDF',
                        title: 'Branch List',
                        orientation:'landscape',
                        exportOptions: {
                            columns: [1,2,3,4,5]
                        },
                        customize: function ( doc ) {
                            var colCount = new Array();
                            $("#BranchTable").find('tbody tr:first-child td').each(function(){
                                if($(this).attr('colspan')){
                                    for(var i=1;i<=$(this).attr('colspan');$i++){
                                        colCount.push('*');
                                    }
                                }else{ 
                                    colCount.push('*'); 
                                }
                            });
                            doc.defaultStyle.alignment = 'center';
                            colCount = colCount.shift();
                            doc.content[1].table.widths = colCount;
                            
                            doc.content.splice( 1, 0, {
                                margin: [ 0, 0, 0, 12 ],
                                alignment: 'center',
                                image: logo
                            } );
                        }
                    },
                    {
                        text:'Export Excel',
                        extend: 'excelHtml5',
                        title: 'Branch List',
                        exportOptions: {
                            columns: [1,2,3,4,5]
                        }
                    }
                    ]
                    // responsive: true
                });
                tableObj.draw();
            }
        });
    }

    $(".addbtn").click(function() {
        var uid = "add";
        $.ajax({
            type: "POST",
            url: "{{ url('branch/getModal')}}",
            data: {
                uid: uid
            },
            success: function(response) {
                $("#modal-view").modal('toggle');
                $("#modal-view").find(".modal-title").text("Add Branch");
                $("#modal-view").find("#modal-display").html(response);
            }
        });
    });

    $("#BranchTable").on("click", ".editbtn", function() {
        var uid = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: "{{ url('branch/getModal')}}",
            data: {
                uid: uid
            },
            success: function(response) {
                $("#modal-view").modal('toggle');
                $("#modal-view").find(".modal-title").text("Edit Branch");
                $("#modal-view").find("#modal-display").html(response);
            }
        });
    });

    $("#BranchTable").on("click", ".delbtn", function() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, proceed!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {

                var code = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url: "{{ url('branch/delete')}}",
                    dataType: 'json',
                    data: {
                        code: code,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: response.title,
                                text: response.msg,
                                timer: 2500
                            })

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

            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Data is safe.',
                    'error'
                )
            }
        })
    });

</script>
@endsection
