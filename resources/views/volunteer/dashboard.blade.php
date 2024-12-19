@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{asset('assets/chosen/chosen.min.css')}}" />
<style>

</style>


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
                            <li class="list-group-item">
                                <input type="hidden" id="copyLinkInput" value="{{ route('volunteer.show_public', ['id'=>$volunteer->id]) }}" readonly>
                                <button class="btn btn-sm btn-primary" id="copyLinkButton">Copy profile Link</button>
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
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
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
                                                    <a href="{{route('training_event_show', ['id'=>$training->id])}}"><i class="fa fa-briefcase"></i><b class="ml-2">{{$training->training_event_name}}</b></a>
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



                                <div id="dynamic-internalfields-container">
                                    <!-- Dynamic fields will be added here -->
                                </div>


                                @if(Auth::user()->is_admin == 0)
                                <button type="button" class="btn btn-primary mt-2" id="add-internaltraining-button" disabled>You are not volunteer yet</button>
                               @else
                               <button type="button" class="btn btn-primary mt-2" id="add-internaltraining-button">Add New Training +</button>
                               @endif
                                

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



                                <div id="dynamic-fields-container">
                                    <!-- Dynamic fields will be added here -->
                                </div>


                               @if(Auth::user()->is_admin == 0)
                               <button type="button" class="btn btn-primary mt-2" id="add-training-button" disabled>You are not Volunteer Yet</button>
                               @else
                               <button type="button" class="btn btn-primary mt-2" id="add-training-button">Add New Training +</button>
                               @endif




                                <hr>


                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">
                                    <h4><b class="text-muted">Volunteer Password Change</b></h4><hr>
                                    <div class="form-group row mt-2">
                                    
                                        <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Confirm New Password</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName2" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
<script src="{{asset('assets/chosen/chosen.jquery.min.js')}}"></script>
<script>
    document.getElementById('add-training-button').addEventListener('click', function() {
        // Get the container where fields will be added
        
        // let addButton = document.querySelector('#add-training-button');
        // if (addButton) {
        //     alert('You are not Volunteer');
        //     // addButton.disabled = true;
        // }
       
        const container = document.getElementById('dynamic-fields-container');

        // Create a new div for training fields
        const trainingFields = document.createElement('div');
        trainingFields.classList.add('training-fields', 'mb-3');

        // Add the input fields dynamically
        trainingFields.innerHTML = `
        <div class="card p-3">
        <div class="form-group">
            <label for="training_name">Training Name</label>
            <input id="training_name" type="text" name="training_name" class="form-control" placeholder="Enter training name">
        </div>
        <div class="form-group">
            <label for="duration">Duration</label>
            <input id="duration" type="text" name="duration" class="form-control" placeholder="Enter duration">
        </div>
        <div class="form-group">
            <label for="attend_date">Attend Date</label>
            <input id="attend_date" type="date" name="attend_date" class="form-control">
        </div>
        <div class="form-group">
            <label for="organization_name">Organization Name</label>
            <input id="organization_name" type="text" name="organization_name" class="form-control" placeholder="Enter organization name">
        </div>
        <div class="card-footer">
        <button type="button" class="float-left btn btn-danger remove-training-button">Remove</button>
        <button type="button" class="float-right btn btn-primary save-training-button">Save</button>
        </div>
        </div>
        <hr> `;

        // Append the new fields to the container
        container.appendChild(trainingFields);

        // Add event listener to the remove button
        trainingFields.querySelector('.remove-training-button').addEventListener('click', function() {
            trainingFields.remove();
        });



        trainingFields.querySelector('.save-training-button').addEventListener('click', function() {
            let training_name = $('#training_name').val();
            let duration = $('#duration').val();
            let attend_date = $('#attend_date').val();
            let organization_name = $('#organization_name').val();
            // alert(training_name+duration+attend_date+organization_name);

            $.ajax({
                url: "{{route('volunteer.external_training.store')}}", // Update with your route
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                    training_name: training_name,
                    duration: duration,
                    attend_date: attend_date,
                    organization_name: organization_name,
                },
                success: function(response) {
                    // alert(response.external_trainings);
                    table_of_trainings(response.external_trainings);
                    // location.reload(); // Optional: Reload the page or handle UI update
                },
                error: function(xhr) {
                    alert('An error occurred while saving trainings!');
                },
            });


            function table_of_trainings(trainings) {
                html = ``;

                trainings.map((training, index) => {
                    html += `
        <div class="post">
            <div class="user-block">
                <span class="username">
                    <h5>
                        <i class="fa fa-briefcase"></i>
                        <b class="ml-2">${training.training_name}</b>
                    </h5>
                </span>
                <span class="description">
                    Attend Date: ${training.attend_date} | Duration: ${training.duration} | Organization: ${training.organization_name}
                </span>
            </div>
            <!-- /.user-block -->
            <p>
                                                Lorem ipsum represents a long-held tradition for designers,

                                            </p>
           
        </div>
    `;
                });


                $('.external_trainings').html(html);
                trainingFields.remove();
            }
        });



    });




    document.getElementById('add-internaltraining-button').addEventListener('click', function() {
        const internalcontainer = document.getElementById('dynamic-internalfields-container');

        const internaltrainingFields = document.createElement('div');
        internaltrainingFields.classList.add('internaltraining-fields', 'mb-3');

        // Add the input fields dynamically
        internaltrainingFields.innerHTML = `
        <div class="card p-3">
        <div class="form-group">
            <label for="internal_trainings">Training Event internal_trainings</label>
                <select class="form-control" name="training_id" id="internal_trainings" data-placeholder="Select internal_training">
                    @foreach($total_trainings as $internal_training)
                    <option value="{{$internal_training->id}}">{{$internal_training->training_event_name}}</option>
                    @endforeach
                </select>
        </div>
        <div class="form-group">
            <label for="designation">Designation</label>
            <input id="designation" type="text" name="designation" class="form-control" placeholder="Enter designation">
        </div>
        <input type="hidden" name="volunteer_id" value="{{$volunteer->id}}" id="volunteer_id">
        <input type="hidden" name="status" value="applied" id="status">
        <div class="card-footer">
        <button type="button" class="float-left btn btn-danger remove-internaltraining-button">Remove</button>
        <button type="button" class="float-right btn btn-primary save-internaltraining-button">Save</button>
        </div>
        </div>
        <hr> `;

        // Append the new fields to the container
        internalcontainer.appendChild(internaltrainingFields);

        // Add event listener to the remove button
        internaltrainingFields.querySelector('.remove-internaltraining-button').addEventListener('click', function() {
            internaltrainingFields.remove();
        });

        $('#internal_trainings').chosen();



        internaltrainingFields.querySelector('.save-internaltraining-button').addEventListener('click', function() {

            let training_id = $('#internal_trainings').val();
            let designation = $('#designation').val();
            let volunteer_id = $('#volunteer_id').val();
            let status = $('#status').val();



            $.ajax({
                url: "{{route('volunteer.interternal_training.store')}}", // Update with your route
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                    training_id: training_id,
                    designation: designation,
                    volunteer_id: volunteer_id,
                    status: status,
                },
                success: function(response) {
                    // alert('success');
                    tables_of_trainings(response.internal_trainings);
                    // location.reload(); // Optional: Reload the page or handle UI update
                },
                error: function(xhr) {
                    alert('An error occurred while saving trainings!');
                },
            });


            function tables_of_trainings(trainings) {
                html = ``;

                trainings.map((training, index) => {
                    html += `
        <div class="post">
            <div class="user-block">
                <span class="username">
                    <h5>
                        <i class="fa fa-briefcase"></i>
                        <b class="ml-2">${training.training_event_name}</b>
                    </h5>
                </span>
                <span class="description">
                    Attend Date: ${training.created_at} | Duration: ${training.training_event_duration} | Organization: BDRCS
                </span>
            </div>
            <!-- /.user-block -->

            <p>
                                                Lorem ipsum represents a long-held tradition for designers,

                                            </p>
           
        </div>
    `;
                });


                $('.internal_trainings').html(html);
                internaltrainingFields.remove();
            }


        });
    });
</script>
<script>
    document.getElementById('copyLinkButton').addEventListener('click', async function() {
        try {
            const copyText = document.getElementById('copyLinkInput').value;
            await navigator.clipboard.writeText(copyText);

            // Show confirmation
            let copyElement = document.querySelector('#copyLinkButton');
            copyElement.innerText = 'Copied';
        } catch (err) {
            console.error('Failed to copy: ', err);
        }
    });
</script>


@endsection