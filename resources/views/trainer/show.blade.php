@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{$trainer->trainer_name}}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <h4 class="text-muted"><b>Trainer's Name:</b></h4>
        <h4>{{$trainer->trainer_name}}</h4>
        <h4 class="text-muted"><b>Trainer's Designation:</b></h4>
        <h4>{{$trainer->trainer_designation}}</h4>
    </div>
</div>
@endsection