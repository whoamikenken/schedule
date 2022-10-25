<div class="row animate__animated animate__fadeInUp" id="pagination_data">
    @unless (count($result) == 0)
        @foreach ($result as $item)
        @php
            $color = "red";
            if($item->bio_availability == "Available") $color = "green";
            if($item->bio_availability == "Signed Up") $color = "teal";
            if($item->bio_availability == "Resell/Push") $color = "teal";
            if($item->bio_availability == "Pending") $color = "blue";
            if($item->bio_availability == "Backed out") $color = "#ffc107";
        @endphp
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card mb-3 shadow-sm" >
                    <div class="row g-0">
                        <div class="col-4">
                            @if ($item->user_profile)
                                <img src="{{  Storage::disk('s3')->url($item->user_profile)}}" id="{{$item->applicant_id}}" class="img-fluid user_photo_list rounded animate__animated animate__fadeIn animate__delay-1s m-2" alt="..." style="height: -webkit-fill-available;">
                            @else
                                <img src="{{ asset('images/user.png')}}" class="img-fluid user_photo_list rounded animate__animated animate__fadeIn animate__delay-1s" alt="...">
                            @endif
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$item->fname." ".$item->lname}}</h5>
                                <p >Jobsite: {{$item->jobsite}}<br>
                                Branch: {{$item->branch}}<br>
                                Status: <span style="color:{{ ($item->isactive == "Active") ? "green":"red"  }}">{{$item->isactive}}</span><br>
                                Availability: <span style="color:{{ $color  }}">{{$item->bio_availability}}</span></p>
                                <button class="btn btn-info text-white applicantView" uid="{{$item->applicant_id}}"><i class="bi bi-eye"></i>&nbsp;&nbsp;View</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
            <h2 class="text-center">No Applicant</h2>
    @endunless
</div>

<div id="paginationApplicant" class="justify-content-center">
  {{ $result->links() }}
</div>

<script>
    $(document).ready(function () {
        // $(".user_photo_list").each(function() {  
        //     imgsrc = this.src;
        //     console.log(imgsrc);
        //     var imgID = $(this).attr("id");
        //     watermark([imgsrc, "{{ asset('Icon/favicon-96x96.png') }}"])
        //     // .image(watermark.text.lowerRight('KINGSMANPOWER', '28px serif', '#fff', 0.5))
        //     .image(watermark.image.upperRight(0.5))
        //     .then(function (img) {
        //         $(img).addClass("img-fluid user_photo_list rounded animate__animated animate__fadeIn animate__delay-1s m-2");
        //         $(img).css("height", "-webkit-fill-available");
        //         console.log($("#"+imgID));
        //         $("#"+imgID).replaceWith(img);
        //     });
        // });  
    });
</script>
