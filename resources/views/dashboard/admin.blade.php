<style>
    .border-left-primary {
        border-left: 0.25rem solid #4e73df!important;
    }
    .border-left-info {
        border-left: 0.25rem solid #36b9cc!important;
    }
    .border-left-warning {
        border-left: 0.25rem solid #f6c23e!important;
    }
    .border-left-success {
        border-left: 0.25rem solid #18ff5d!important;
    }
</style>
<div class="row animate__animated animate__backInRight">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Registered Applicant {{ date("F")}}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$registeredApplicantMonth}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-people fs-1 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Upcoming Departure</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$upcomingDeparture}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-airplane-engines fs-1 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Active Applicant</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$active_applicant}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-person-check fs-1 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Expired VISA/PASSPORT</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$expired_applicant}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi-bookmark-x fs-1 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<div class="row animate__animated animate__fadeInRight">
    <div class="col-sm-12 col-md-12 col-xl-8">
        <div class="card mb-4">
            <div class="card-header bg-info">
                <i class="bi bi-bar-chart-line-fill me-1"></i>
                Performance Report
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center" id="performanceLoader">
                    <div class="spinner-border text-info" role="status" style="width: 8rem; height: 8rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <canvas id="myBarChart" width="100%" height="47"></canvas>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-xl-4">
        <div class="card mb-4">
            <div class="card-header bg-info">
                <i class="bi bi-bar-chart-line-fill me-1"></i>
                Bio Status
            </div>
            <div class="card-body"><canvas id="myBioChart" width="100%" height="47"></canvas></div>
        </div>
    </div>
</div>

<div class="row animate__animated animate__fadeInRight">
    <div class="col-sm-12 col-md-12 col-xl-8">
        <div class="card mb-4">
            <div class="card-header bg-info">
                <i class="bi bi-bar-chart-line-fill me-1"></i>
                Branch Performance
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center" id="branchPerformanceLoader">
                    <div class="spinner-border text-info" role="status" style="width: 8rem; height: 8rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <canvas id="branchBarChart" width="100%" height="47"></canvas>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-xl-4 animate__animated animate__backInRight">
        <div class="card mb-4">
            <div class="card-header bg-info">
                <i class="bi bi-pie-chart-fill me-1"></i>
                Branches Applicants
            </div>
            <div class="card-body"><canvas id="pieChartBranch" width="100%" height="40"></canvas></div>
        </div>
    </div>
</div>

<div class="row" id="performanceBar">
    <div class="col-sm-12">
        <div class="card mb-4">
            <div class="card-header bg-info">
                <i class="bi bi-award-fill me-1"></i>
                Top Performing Sales Of  {{ date("F")}}
            </div>
            <div class="card-body">
                <div class="row animate__animated animate__fadeInUp">
                    @unless (count($top_sales) == 0)
                    @php
                        $counter = 1;
                    @endphp
                    @foreach ($top_sales as $item)
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card mb-3 shadow" >
                                <div class="row g-0">
                                    <div class="col-4">
                                        @if ($item->user_image)
                                            <img src="{{  Storage::disk('s3')->url($item->user_image)}}" class="img-fluid user_photo_list rounded animate__animated animate__fadeIn animate__delay-1s m-2" alt="..." style="height: -webkit-fill-available;">
                                        @else
                                            @if ($item->gender == "male")
                                                <img src="{{ asset('images/male_sales.png')}}" class="img-fluid user_photo_list rounded animate__animated animate__fadeIn animate__delay-1s" alt="...">
                                            @elseif ($item->gender == "female")
                                                <img src="{{ asset('images/female_sales.png')}}" class="img-fluid user_photo_list rounded animate__animated animate__fadeIn animate__delay-1s" alt="...">
                                            @else
                                                <img src="{{ asset('images/user.png')}}" class="img-fluid user_photo_list rounded animate__animated animate__fadeIn animate__delay-1s" alt="..."> 
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$item->fname." ".$item->lname}} <span class="float-end">{{$counter}}</span></h5>
                                            Branch: {{$item->branchdesc}}<br>
                                            Applicant Processed: {{$item->total_sales}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $counter++;
                        @endphp
                    @endforeach
                @else
                        <h2 class="text-center">No Applicant</h2>
                @endunless
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
let delayed;

    $(document).ready(function () {
        getBranchApplicant();
        getBioStatusApplicant();
        getPerformancePerMonth();
        getBranchPerformancePerMonth();
    });

    $(window).scroll(function () {
        if ($('#performanceBar').isOnScreen()) {
            $("#performanceBar").addClass("animate__animated animate__fadeInRight");
        } else {
            $("#performanceBar").removeClass("animate__animated animate__fadeInRight");
        }
    });

    function getBioStatusApplicant(){
        $.ajax({
            type: "GET",
            url: "{{ url('dashboard/getBiostatusPie')}}",
            data: {},
            dataType: "json",
            success:function(response){

                const config = {
                    type: 'pie',
                    data: {
                        labels: JSON.parse(response.label),
                        datasets: [{
                        label: "Bio Status",
                        backgroundColor: [
                        'rgb(0, 255, 25)',
                        'rgb(255, 0, 21)',
                        'rgb(0, 153, 255)'
                        ],
                        data: JSON.parse(response.data),
                        }],
                    },
                    options: {
                    responsive: true,
                    plugins: {
                      legend: {
                        position: 'top',
                      },
                      title: {
                        display: true,
                        text: 'Bio Status'
                      }
                    }
                  }
                };

                const myChart = new Chart(
                    document.getElementById('myBioChart'),
                    config
                );
            }
        });
    }

    function getBranchApplicant(){
        $.ajax({
            type: "GET",
            url: "{{ url('dashboard/getBranchPie')}}",
            data: {},
            dataType: "json",
            success:function(response){

                const config = {
                    type: 'pie',
                    data: {
                        labels: JSON.parse(response.label),
                        datasets: [{
                        label: "Branches",
                        backgroundColor: [
                        'rgb(255, 0, 21)',
                        'rgb(255, 0, 242)',
                        'rgb(127, 0, 255)',
                        'rgb(21, 0, 255)',
                        'rgb(0, 153, 255)',
                        'rgb(0, 255, 25)',
                        'rgb(234, 255, 5)'
                        ],
                        data: JSON.parse(response.data),
                        }],
                    },
                    options: {
                    responsive: true,
                    plugins: {
                      legend: {
                        position: 'top',
                      },
                      title: {
                        display: true,
                        text: 'Branches'
                      }
                    }
                  }
                };

                const myChart = new Chart(
                    document.getElementById('pieChartBranch'),
                    config
                );
            }
        });
    }

    function getDeparturePerMonth(){
        $.ajax({
            type: "GET",
            url: "{{ url('dashboard/getDepartureMontly')}}",
            data: {},
            dataType: "json",
            success:function(response){
                
                const config = {
                    type: 'bar',
                    data: {
                        labels: JSON.parse(response.month),
                        datasets: [{
                        label: "Departure",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: JSON.parse(response.data),
                        }],
                    },
                    options: {
                    scales: {
                      xAxes: [{
                        time: {
                          unit: 'month'
                        },
                        gridLines: {
                          display: false
                        }
                      }],
                      yAxes: [{
                        ticks: {
                          min: 200,
                          max: JSON.parse(response.high),
                          maxTicksLimit: 5
                        },
                        gridLines: {
                          display: true
                        }
                      }],
                    },
                    legend: {
                      display: false
                    }
                  },
                };

                const myChart = new Chart(
                    document.getElementById('branchBarChart'),
                    config
                );

            }
        });
    }

    function getPerformancePerMonth(){
        $.ajax({
            type: "GET",
            url: "{{ url('dashboard/getPerformanceMontly')}}",
            data: {},
            dataType: "json",
            success:function(response){
                $("#performanceLoader").remove();
                const config = {
                    type: 'bar',
                    data: {
                        labels: JSON.parse(response.month),
                        datasets: [
                            {
                            label: "Departure",
                            backgroundColor: "rgb(0, 255, 25)",
                            borderColor: "rgb(214, 252, 0)",
                            data: JSON.parse(response.departure.data),
                            borderRadius: 5,
                            borderWidth: 2,
                            },
                            {
                            label: "Job Order",
                            backgroundColor: "rgba(2,117,216,1)",
                            borderColor: "rgb(0, 0, 0)",
                            data: JSON.parse(response.joborder.data),
                            borderRadius: 5,
                            borderWidth: 2,
                            },  
                            {
                            label: "Applicant Registered",
                            backgroundColor: "rgb(54, 185, 204)",
                            borderColor: "rgb(23, 79, 86)",
                            data: JSON.parse(response.applicant.data),
                            borderRadius: 5,
                            borderWidth: 2,
                            },
                        ],
                    },
                    options: {
                        animation: {
                            onComplete: () => {
                                delayed = true;
                            },
                            delay: (context) => {
                                let delay = 0;
                                if (context.type === 'data' && context.mode === 'default' && !delayed) {
                                delay = context.dataIndex * 300 + context.datasetIndex * 100;
                                }
                                return delay;
                            },
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Performance Chart'
                            },
                        },
                        responsive: true,
                        scales: {
                            x: {
                                // stacked: true,
                            },
                            y: {
                                // stacked: true
                            }
                        }
                    },
                };

                const myChart = new Chart(
                    document.getElementById('myBarChart'),
                    config
                );

            }
        });
    }

    function getBranchPerformancePerMonth(){
        $.ajax({
            type: "GET",
            url: "{{ url('dashboard/getPerformanceBranchMontly')}}",
            data: {},
            dataType: "json",
            success:function(response){
                $("#branchPerformanceLoader").remove();
                const config = {
                    type: 'bar',
                    data: {
                        labels: JSON.parse(response.month),
                        datasets: 
                                response.dataset
                        
                        ,
                    },
                    options: {
                        animation: {
                            onComplete: () => {
                                delayed = true;
                            },
                            delay: (context) => {
                                let delay = 0;
                                if (context.type === 'data' && context.mode === 'default' && !delayed) {
                                delay = context.dataIndex * 300 + context.datasetIndex * 100;
                                }
                                return delay;
                            },
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Deployed Applicant Per Branch'
                            },
                        },
                        responsive: true,
                        scales: {
                            x: {
                                // stacked: true,
                            },
                            y: {
                                // stacked: true
                            }
                        }
                    },
                };

                const myChart = new Chart(
                    document.getElementById('branchBarChart'),
                    config
                );

            }
        });
    }


</script>