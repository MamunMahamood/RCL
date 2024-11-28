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
                <div class="form-group col-sm-6">
                    <label for="training_event_name">Training Event Name<span style="color:red; margin-left:5px">*</span></label>
                    <input type="text" class="form-control" id="training_event_name" placeholder="Enter Training Event Name" autocomplete="off" name="training_event_name">
                    @if ($errors->has('training_event_name'))
                    <div class="alert alert-danger">
                        {{ $errors->first('training_event_name') }}
                    </div>
                    @endif

                </div>
                <div class="form-group col-sm-6">
                    <label for="training_event_type">Training Event Type<span style="color:red; margin-left:5px">*</span></label>
                    <input type="text" class="form-control" id="training_event_type" placeholder="Select Training Event Type" autocomplete="off" name="training_event_type">
                    @if ($errors->has('training_event_type'))
                    <div class="alert alert-danger">
                        {{ $errors->first('training_event_type') }}
                    </div>
                    @endif

                </div>
                <div class="form-group col-sm-6">
                    <label for="budget_amount">Training Event Budget Amount</label>
                    <input type="text" class="form-control" id="budget_amount" placeholder="Enter Budget Amount" autocomplete="off" name="budget_amount">
                </div>
                <div class="form-group col-sm-6">
                    <label for="training_event_duration">Training Event Duration<span style="color:red; margin-left:5px">*</span></label>
                    <input type="text" class="form-control" id="training_event_duration" placeholder="Enter Training Event Duration" autocomplete="off" name="training_event_duration">
                    @if ($errors->has('training_event_type'))
                    <div class="alert alert-danger">
                        {{ $errors->first('training_event_type') }}
                    </div>
                    @endif

                </div>
                <div class="form-group col-sm-6">
                    <label for="training_event_location">Training Event Location<span style="color:red; margin-left:5px">*</span></label>
                    <input type="text" class="form-control" id="training_event_location" placeholder="Enter Training Event Location" autocomplete="off" name="training_event_location">
                    @if ($errors->has('training_event_location'))
                    <div class="alert alert-danger">
                        {{ $errors->first('training_event_location') }}
                    </div>
                    @endif

                </div>
                <div class="form-group col-sm-6">
                    <label for="training_event_total_members">Training Event Total Members<span style="color:red; margin-left:5px">*</span></label>
                    <input type="text" class="form-control" id="training_event_total_members" placeholder="Enter Training Event Total Members" autocomplete="off" name="training_event_total_members">
                    @if ($errors->has('training_event_total_members'))
                    <div class="alert alert-danger">
                        {{ $errors->first('training_event_total_members') }}
                    </div>
                    @endif

                </div>
                <div class="form-group col-sm-6">
                    <label for="training_event_banner_img">Training Event Banner Image</label>
                    <input type="file" class="form-control" id="training_event_banner_img" placeholder="Select Training Event Banner Image" autocomplete="off" name="training_event_banner_img">
                </div>
                <div class="form-group col-sm-6">
                    <label for="training_event_schedule">Training Event Schedule</label>
                    <input type="text" class="form-control" id="training_event_schedule" placeholder="Enter Training Event Schedule" autocomplete="off" name="training_event_schedule">
                </div>

                <div class="form-group col-sm-6">
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

                <div class="form-group col-12">
                    <label for="note">Training Event Short Notes</label>
                    <textarea type="text" class="form-control" id="note" placeholder="Enter Note" autocomplete="off" name="note"></textarea>
                </div>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    Training Member Selection
                </div>
                <div class="card-body training-member">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="volunteer">Training Mamber Name</label>
                            <select class="form-control" name="volunteer_id[]" id="volunteer" data-placeholder="Select Volunteer">
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
                        <div class="form-group col-sm-6">
                            <label for="">Designation</label>
                            <input type="text" class="form-control" name="designation[]" placeholder="Enter Designation">
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button id="addNewMember" class="btn btn-primary">Add New Member Field<span><b>+</b></span></button>
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
        $('#training_event_trainers').chosen(); // Initialize for existing trainers select
        $('#volunteer').chosen(); // Initialize for the first volunteer select
    });

    $('#addNewMember').click((e) => {
        e.preventDefault();

        let newFieldHtml = `
            <div class="row mt-3">
                <div class="form-group col-sm-6">
                    <label for="volunteer">Training Member Name</label>
                    <select class="form-control volunteer-select" name="volunteer_id[]" data-placeholder="Select Volunteer">
                        <option value="">Select Volunteer...</option>
                        @foreach($volunteers as $volunteer)
                        <option value="{{$volunteer->id}}">{{$volunteer->user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label for="designation">Designation</label>
                    <input type="text" class="form-control" name="designation[]" placeholder="Enter Designation">
                </div>
            </div>
        `;

        // Append new fields to the training member section
        $('.training-member').append(newFieldHtml);

        // Reinitialize Chosen for the newly added fields
        $('.volunteer-select').chosen();
    });
</script>

@endsection