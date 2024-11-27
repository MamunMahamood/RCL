@extends('layouts.app')
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
                    <label for="trainer_name">trainer Event Name<span style="color:red; margin-left:5px">*</span></label>
                    <input type="text" class="form-control" id="trainer_name" placeholder="Enter trainer Event Name" autocomplete="off" name="trainer_name">
                    @if ($errors->has('trainer_name'))
                    <div class="alert alert-danger">
                        {{ $errors->first('trainer_name') }}
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