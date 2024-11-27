@extends('layouts.app')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add New Unit</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('unit_store')}}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="unit_name">Unit Name<span style="color:red; margin-left:5px">*</span></label>
                <input type="text" class="form-control" id="unit_name" placeholder="Enter Unit Name" autocomplete="off" name="unit_name">
                @if ($errors->has('unit_name'))
                <div class="alert alert-danger">
                    {{ $errors->first('unit_name') }}
                </div>
                @endif

            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>
@endsection