@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title float-left col-6">volunteers Table</h3>
        <input type="text" class="form-control float-right col-6" placeholder="Search volunteer Event" id="search">
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Role</th>
                        <th>volunteer Email</th>
                        <th>Phone Number</th>
                        <th>Blood Group</th>
                        <th>Review Points</th>
                        <th>Action</th>
                        <!-- <th style="width: 40px">Label</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($volunteers as $index=>$volunteer)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td><a href="{{route('volunteer.show', ['id'=>$volunteer->id])}}">{{$volunteer->user->name}}</a></td>
                        <td>{{$volunteer->designation}}</td>
                        <td>{{$volunteer->user->is_admin == 1? 'Admin':'Volunteer'}}</td>
                        <td>{{$volunteer->email}}</td>
                        <td>{{$volunteer->phone_number}}</td>
                        <td>{{$volunteer->blood_group}}</td>
                        <td><span>{{ number_format($volunteer->review_points, 1) }}</span></td>
                        <td>
                            <div class="d-flex">
                                <a class="badge badge-primary" href="{{route('volunteer.show_performance', ['id'=>$volunteer->id])}}">Detail</a> 
                                @if($volunteer->user->is_admin == 2) 
                                <a class="badge badge-danger ml-2" href="{{route('volunteer.unset_admin', ['id'=>$volunteer->id])}}">Unset Admin</a>
                                @elseif($volunteer->user->is_admin == 0)
                                <a class="badge badge-success ml-2" href="{{route('volunteer.approve_volunteer', ['id'=>$volunteer->id])}}">Approve Volunteer</a>
                                @else
                                <a class="badge badge-success ml-2" href="{{route('volunteer.set_admin', ['id'=>$volunteer->id])}}">Set Admin</a>
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
        <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item"><a class="page-link" href="#">«</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">»</a></li>
        </ul>
    </div>
</div>
@endsection