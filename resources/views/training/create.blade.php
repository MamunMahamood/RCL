@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{asset('assets/chosen/chosen.min.css')}}" />

@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New Training Event</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('training_event_store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                    <label for="training_event_name">Training Event Name<span style="color:red; margin-left:5px">*</span></label>
                    <input type="text" class="form-control" id="training_event_name" placeholder="Enter Training Event Name" autocomplete="off" name="training_event_name">
                    @if ($errors->has('training_event_name'))
                    <div class="alert alert-danger">
                        {{ $errors->first('training_event_name') }}
                    </div>
                    @endif

                </div>
                <div class="form-group col-6">
                    <label for="training_event_type">Training Event Type<span style="color:red; margin-left:5px">*</span></label>
                    <input type="text" class="form-control" id="training_event_type" placeholder="Select Training Event Type" autocomplete="off" name="training_event_type">
                    @if ($errors->has('training_event_type'))
                    <div class="alert alert-danger">
                        {{ $errors->first('training_event_type') }}
                    </div>
                    @endif

                </div>
                <div class="form-group col-6">
                    <label for="training_event_duration">Training Event Duration<span style="color:red; margin-left:5px">*</span></label>
                    <input type="text" class="form-control" id="training_event_duration" placeholder="Enter Training Event Duration" autocomplete="off" name="training_event_duration">
                    @if ($errors->has('training_event_type'))
                    <div class="alert alert-danger">
                        {{ $errors->first('training_event_type') }}
                    </div>
                    @endif

                </div>
                <div class="form-group col-6">
                    <label for="training_event_location">Training Event Location<span style="color:red; margin-left:5px">*</span></label>
                    <input type="text" class="form-control" id="training_event_location" placeholder="Enter Training Event Location" autocomplete="off" name="training_event_location">
                    @if ($errors->has('training_event_location'))
                    <div class="alert alert-danger">
                        {{ $errors->first('training_event_location') }}
                    </div>
                    @endif

                </div>
                <div class="form-group col-6">
                    <label for="training_event_total_members">Training Event Total Members<span style="color:red; margin-left:5px">*</span></label>
                    <input type="text" class="form-control" id="training_event_total_members" placeholder="Enter Training Event Total Members" autocomplete="off" name="training_event_total_members">
                    @if ($errors->has('training_event_total_members'))
                    <div class="alert alert-danger">
                        {{ $errors->first('training_event_total_members') }}
                    </div>
                    @endif

                </div>
                <div class="form-group col-6">
                    <label for="training_event_banner_img">Training Event Banner Image</label>
                    <input type="file" class="form-control" id="training_event_banner_img" placeholder="Select Training Event Banner Image" autocomplete="off" name="training_event_banner_img">


                </div>
                <div class="form-group col-6">
                    <label for="training_event_schedule">Training Event Schedule</label>
                    <input type="text" class="form-control" id="training_event_schedule" placeholder="Enter Training Event Schedule" autocomplete="off" name="training_event_schedule">
                </div>

                <div class="form-group col-6">
                    <label for="training_event_trainers">Training Event Trainers</label>
                    <select class="form-control" name="training_event_trainers[]" id="training_event_trainers" multiple data-placeholder="Select Trainer">
                        @foreach($trainers as $trainer)
                        <option value="{{$trainer->id}}">{{$trainer->trainer_name}}</option>
                        @endforeach
                    </select>
                </div>



                <div class="form-group col-12">
                    <label for="training_event_description">Training Event Description</label>
                    <textarea type="text" class="form-control" id="training_event_description" placeholder="Enter Training Event description" autocomplete="off" name="training_event_description"></textarea>


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
        $('#training_event_trainers').chosen();
    });
</script>
@endsection