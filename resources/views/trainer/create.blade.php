@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{asset('assets/chosen/chosen.min.css')}}" />

@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New trainer Event</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('trainer.store')}}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                    <label for="volunteer">Training Event Trainers</label>
                    <select class="form-control" name="volunteer_id" id="volunteer" data-placeholder="Select Volunteer">
                    <option value="">Select Volunteer...</option>
                        @foreach($volunteers as $volunteer)
                        <option value="{{$volunteer->id}}">{{$volunteer->user->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('volunteer_id'))
                    <div class="alert alert-danger">
                        {{ $errors->first('volunteer_id') }}
                    </div>
                    @endif
                </div>
                
                <div class="form-group col-6">
                    <label for="trainer_designation">Trainer Designation<span style="color:red; margin-left:5px">*</span></label>
                    <input type="text" class="form-control" id="trainer_designation" placeholder="Enter trainer Designation" autocomplete="off" name="trainer_designation">
                    @if ($errors->has('trainer_designation'))
                    <div class="alert alert-danger">
                        {{ $errors->first('trainer_designation') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>
@endsection
@section('script')
<script src="{{asset('assets/chosen/chosen.jquery.min.js')}}"></script>
<script>
    $(function() {
        $('#volunteer').chosen();
    });
</script>
@endsection
