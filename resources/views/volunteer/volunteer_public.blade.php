@extends('layouts.master')
@section('style')
<link rel="stylesheet" href="{{asset('assets/chosen/chosen.min.css')}}" />

@endsection
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{$volunteer->profile_picture? $volunteer->profile_picture: asset('assets/image/dphoto.jpg')}}"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{$volunteer? $volunteer->user->name : ''}}</h3>

                        <p class="text-muted text-center">{{$volunteer? $volunteer->designation : ''}}</p>
                        <p class="text-muted text-center">{{$volunteer? $volunteer->email : ''}}</p>
                        <p class=" text-center"><strong>Volunteer ID: </strong>{{$volunteer? $volunteer->volunteer_id? $volunteer->volunteer_id : 'Not Yet Approved' : ''}}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Mobile</b> <a class="float-right">{{$volunteer? $volunteer->phone_number : ''}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Blood Group</b> <a class="float-right">{{$volunteer? $volunteer->blood_group : ''}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Joining Date</b> <a class="float-right">{{$volunteer? $volunteer->joining_date : ''}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Blood Donation Count</b> <a class="float-right">{{$volunteer? $volunteer->blood_donation_count : ''}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Review Points</b> <a class="float-right star">{{$volunteer? $volunteer->review_points : ''}}</a>
                            </li>
                        </ul>

                        <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>

                        <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                        <p class="text-muted">Malibu, California</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                        <p class="text-muted">
                            <span class="tag tag-danger">UI Design</span>
                            <span class="tag tag-success">Coding</span>
                            <span class="tag tag-info">Javascript</span>
                            <span class="tag tag-warning">PHP</span>
                            <span class="tag tag-primary">Node.js</span>
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">

                            <li class="nav-item"><a class="nav-link active" href="#training" data-toggle="tab">Training Programs</a></li>
                            <!-- <li class="nav-item"><a class="nav-link" href="#stat" data-toggle="tab">Stat Bar</a></li> -->
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">

                            <!-- /.tab-pane -->
                            <div class="tab-pane active" id="training">
                                <!-- Post -->

                                <h4><b>Internal Trainings</b></h4>
                                <hr>
                                <div class="internal_trainings">

                                    @if($internal_trainings->count() <= 0)
                                        <p class="font-italic">No Training Available.......</p>
                                        @endif
                                        @foreach($internal_trainings as $training)
                                        <div class="post">
                                            <div class="user-block">

                                                <span class="username">
                                                    <h5 href="#"><i class="fa fa-briefcase"></i><b class="ml-2">{{$training->training_event_name}}</b></h5>
                                                    <!-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> -->
                                                </span>
                                                <span class="description">Attend Date : {{$training->created_at}} | Duration : {{$training->duration}} | Organization: BDRCS</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <p>
                                                Lorem ipsum represents a long-held tradition for designers,

                                            </p>

                                        </div>
                                        @endforeach

                                </div>








                                <br>
                                <hr>

                                <h4><b>External Trainings</b></h4>
                                <hr>
                                <div class="external_trainings">
                                    @if($external_trainings->count() <= 0)
                                        <p class="font-italic">No Training Available.......</p>
                                        @endif
                                        @foreach($external_trainings as $training)
                                        <div class="post">
                                            <div class="user-block">

                                                <span class="username">
                                                    <h5 href="#"><i class="fa fa-briefcase"></i><b class="ml-2">{{$training->training_name}}</b></h5>
                                                    <!-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> -->
                                                </span>
                                                <span class="description">Attend Date : {{$training->attend_date}} | Duration : {{$training->duration}} | Organization: {{$training->organization_name}}</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <p>
                                                Lorem ipsum represents a long-held tradition for designers,
                                                typographers and the like. Some people hate it and argue for
                                                its demise, but others ignore the hate as they create awesome
                                                tools to help create filler text for everyone from bacon lovers
                                                to Charlie Sheen fans.
                                            </p>

                                        </div>
                                        @endforeach

                                </div>








                                <hr>


                                <div class="">
                                    <div class="card">
                                        <div class="card-header">{{$volunteer->user->name}}'s Statistics</div>
                                        <div class="card-body">
                                            <p><b class="text-muted">Rating</b> : {{$volunteer->review_points}}</p>
                                            <p><b class="text-muted">Training Programs Attended</b> : {{$volunteer->trainings()->count()}}</p>
                                            <p><b class="text-muted">Rescue Programs Attended</b> : {{2}}</p>
                                            <p><b class="text-muted">Camp Programs Attended</b> : {{3}}</p>
                                            <p><b class="text-muted">Special Programs Attended</b> : {{4}}</p>
                                            <hr>
                                            <p><b class="text-muted">Total Programs Attended</b> : {{$volunteer->trainings()->count()+2+3+4}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                                </div>



                            </div>
        
                            <!-- /.tab-pane -->


                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection


@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var xValues = ["Trainings ({{$volunteer->trainings()->count()}})", "Rescues (2)", "Camps (3)", "Special Programms (4)"];
        var yValues = ['{{$volunteer->trainings()->count()}}', 2, 3, 4]; // Example data
        var barColors = ["green", "red", "blue", "orange", "brown"];

        // Calculate the maximum value in yValues
        var maxValue = Math.max(...yValues);
        console.log(maxValue);

        // Determine a suitable step size
        function calculateStepSize(maxValue) {
            if (maxValue <= 10) {
                return 1;
            } else if (maxValue <= 50) {
                return 5;
            } else if (maxValue <= 100) {
                return 10;
            } else if (maxValue <= 500) {
                return 50;
            } else {
                return 100;
            }
        }

        var stepSize = calculateStepSize(maxValue);
        console.log(stepSize)

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "{{$volunteer->user->name}}'s Performance Chart"
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: "Event Number"
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: stepSize,
                            callback: function(value) {
                                if (Number.isInteger(value)) {
                                    return value;
                                }
                            }
                        }
                    }]
                }
            }

        });

    });
</script>

@endsection