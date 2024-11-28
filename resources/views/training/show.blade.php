@extends('layouts.app')
@section('content')
<div class="card">
    <!-- Cover Image -->
    <div class="cover">
        <img src="{{ $training_event->training_event_banner_img ? $training_event->training_event_banner_img : asset('assets/image/dcover.jpg') }}"
            alt="Training Event Banner"
            style="width: 100%; height: 380px;">
    </div>
    <div class="p-3">
        <div class="card">
            <div class="card-header">
                <h2><strong>{{$training_event->training_event_name}}</strong></h2>
                <p class="text-muted"><i class="fas fa-tag"></i> {{$training_event->training_event_type}} Event</p>
                <p class="text-muted float-left"><i class="fas fa-map-marker-alt"></i> {{$training_event->training_event_location}}</p>
                <p class="text-muted float-right"><i class="fas fa-clock"></i> {{$training_event->training_event_duration}} | {{$training_event->training_event_schedule? $training_event->training_event_schedule: 'Every Day at 3pm'}} | {{$training_event->created_at}}</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <h5><b class="text-muted"><i class="fas fa-file-alt"></i> Description</b></h5>
                        <p style="text-align:justify;">{{$training_event->training_event_description? $training_event->training_event_description: ''}}</p>
                    </div>
                    <div class="col-4 ml-auto p-3" style="background-color: #EFF9ED;">
                        <h5><b class="text-muted"><i class="fas fa-thumbtack"></i> Trainer's Detail</b></h5>
                        <hr>
                        <h6><b class="text-muted"><i class="fas fa-user"></i> Total Trainers: {{$trainers->count()}}</b></h6>
                        <hr>
                        @foreach($trainers as $trainer)
                        <a href="{{route('trainer.show', ['id'=>$trainer->id])}}"><b>{{$trainer->trainer_name}}</b></a>
                        <p>{{$trainer->trainer_designation}}</p>
                        @endforeach
                        <hr>
                        <h6><b class="text-muted"><i class="fas fa-user"></i> Total Trainee Members : {{$training_event->training_event_total_members}}</b></h6>
                    </div>
                </div>
                <hr>


                <div class="gallery">
                    <h5><b class="text-muted"><i class="fas fa-image"></i> Galleries</b></h5>
                    @if($gallery)
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="card p-2">
                                <img src="{{$gallery->p1}}" alt="" style="width:100%;">
                            </div>
                        </div>
                        <div class="col-6 ml-auto">
                            <div class="card p-2">
                                <div class="row">
                                    <img class="col-6" src="{{$gallery->p1}}" alt="" style="width:100%;">
                                    <img class="col-6" src="{{$gallery->p1}}" alt="" style="width:100%;">
                                </div>
                                <div class="row mt-2">
                                    <img class="col-6" src="{{$gallery->p1}}" alt="" style="width:100%;">
                                    <img class="col-6" src="{{$gallery->p1}}" alt="" style="width:100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <h5 class="font-italic text-primary">There is no Gallery Photo....</h5>
                    @endif

                </div>

                <hr>





            </div>
            <div class="Training_member p-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title float-left col-6">Trainings Table</h3>
                        <input type="text" class="form-control float-right col-6" placeholder="Search Training Event" id="search">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Desination</th>
                                        <th>Status</th>
                                        <th>Action</th>


                                        <!-- <th style="width: 40px">Label</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($training_members as $index=>$training_member)
                                    @php
                                    $volunteer = App\Models\Volunteer::findorfail($training_member->volunteer_id);
                                    @endphp
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td><a href="">{{$volunteer->user->name}}</a></td>
                                        <td>{{$training_member->designation}}</td>
                                        <td><span class="badge badge-{{$training_member->status==='active'? 'success': 'danger'}}">{{$training_member->status}}</span></td>


                                        <td>
                                            <div>
                                                @if($training_member->status === 'active')
                                                <a class="badge badge-danger" href="">Set Inactive</a>
                                                @else
                                                <a class="badge badge-warning" href="">Set Active</a>
                                                <!-- <a class="badge badge-danger" href="">Post OFF</a> -->
                                                 @endif
                                            </div>
                                        </td>
                                        <!-- <td><span class="badge bg-danger">55%</span></td> -->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <div class="float-left">

                            <p class="font-italic">Total Members {{$total_training_members_count}} out of {{$training_event->training_event_total_members}}</p>
                        </div>
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#">«</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">»</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card-footer">
        <a class="btn btn-primary" href="{{route('training_event_edit', ['id'=>$training_event->id])}}">Edit</a>
        <a class="btn btn-danger" href="">Delete</a>
    </div>
</div>
@endsection