@extends('layouts.app')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{Auth::user()->name}}</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('volunteer.store_profile')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <!-- Name -->
                <!-- <div class="form-group col-6">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name">
                </div> -->

                <!-- Designation -->
                <div class="form-group col-6">
                    <label for="designation">Designation</label>
                    <input type="text" class="form-control" id="designation" placeholder="Enter designation" name="designation">
                </div>

                <div class="form-group col-6">
                    <label for="unit">Unit</label>
                    <select class="form-control" id="unit_name" name="unit_id">
                        <option value="">Select Unit</option>
                        @foreach($units as $unit)
                        <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                        @endforeach
                    </select>
                </div>



                <!-- Phone Number -->
                <div class="form-group col-6">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" placeholder="Enter phone number" name="phone_number">
                </div>

                <!-- Joining Date -->
                <div class="form-group col-6">
                    <label for="joining_date">Joining Date</label>
                    <input type="date" class="form-control" id="joining_date" name="joining_date">
                </div>

                

                
                <!-- Email Address -->
                <div class="form-group col-6">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>


                <!-- Extra Skill -->
                <!-- <div class="form-group col-6">
                    <label for="extra_skill">Extra Skill</label>
                    <textarea class="form-control" id="extra_skill" rows="3" placeholder="Enter extra skills"></textarea>
                </div> -->

                <!-- Unique ID -->
                <!-- <div class="form-group col-6">
                    <label for="unique_id">Unique ID</label>
                    <input type="text" class="form-control" id="unique_id" placeholder="Enter unique ID">
                </div> -->

                <div class="form-group col-6">
                    <label for="blood_group">Blood Group</label>
                    <select class="form-control" id="blood_group" name="blood_group">
                        <option value="">Select Blood Group</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>

            

                <!-- Education -->
                <!-- <div class="form-group col-6">
                    <label for="education">Education</label>
                    <textarea class="form-control" id="education" rows="3" placeholder="Enter education details"></textarea>
                </div> -->

                <!-- Awards -->
                <!-- <div class="form-group col-6">
                    <label for="awards">Awards</label>
                    <textarea class="form-control" id="awards" rows="3" placeholder="Enter awards"></textarea>
                </div> -->

                <!-- Blood Group -->
                


                

                <!-- Review Points -->
                <!-- <div class="form-group col-6">
                    <label for="review_points">Review Points</label>
                    <input type="number" class="form-control" id="review_points" placeholder="Enter review points">
                </div> -->

                <!-- Terms Checkbox -->
                <!-- <div class="form-check col-6">
                    <input type="checkbox" class="form-check-input" id="terms">
                    <label class="form-check-label" for="terms">Agree to terms and conditions</label>
                </div> -->

                <!-- Blood Donation Count -->
                <div class="form-group col-6">
                    <label for="blood_donation_count">Blood Donation Count</label>
                    <input type="number" class="form-control" id="blood_donation_count" placeholder="Enter blood donation count" name="blood_donation_count">
                </div>

                <!-- Profile Picture -->
                <div class="form-group col-6">
                    <label for="profile_picture">Profile Picture</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="profile_picture" name="profile_picture">
                            <label class="custom-file-label" for="profile_picture">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Footer -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>


</div>
@endsection