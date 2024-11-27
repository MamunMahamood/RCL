@extends('layouts.app')
@section('content')
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
                        <th>Training Name</th>
                        <th>Training Type</th>
                        <th>Training Duration</th>
                        <th>Location</th>
                        <th>Total Members</th>
                        <th>Action</th>
                        <!-- <th style="width: 40px">Label</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($trainings as $index=>$training)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$training->training_event_name}}</td>
                        <td>{{$training->training_event_type}}</td>
                        <td>{{$training->training_event_duration}}</td>
                        <td>{{$training->training_event_location}}</td>
                        <td>{{$training->training_event_total_members}}</td>
                        <td>
                            <div>
                                <a class="badge badge-primary" href="{{route('training_event_show', ['id'=>$training->id])}}">Detail</a>
                                <a class="badge badge-danger" href="">Post OFF</a>
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

@section('script')
<script>
    $(function() {
        $('#search').on('keyup', function() {
            search();
        });


        function search() {
            var keyword = $('#search').val();
            $.post('{{ route("training_event_search") }}', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword: keyword
                },
                function(data) {
                    training_events_table(data);
                    console.log(data);
                });
        }

        function training_events_table(response) {
            html = '';
            if (response.trainings.length <= 0) {
                html += `
              <tr>
                  <td colspan="7" class="font-italic">No Record Matched</td>
              </tr>
        `;
            }

            response.trainings.map((training, index) => {
                html += `<tr>
    <td>${index + 1}</td>
    <td>${training.training_event_name}</td>
    <td>${training.training_event_type}</td>
    <td>${training.training_event_duration}</td>
    <td>${training.training_event_location}</td>
    <td>${training.training_event_total_members}</td>
    <td>
        <div>
            <a class="badge badge-primary" href="trainings/${training.id}">Detail</a>
            <a class="badge badge-danger" href="#">Post OFF</a>
        </div>
    </td>
</tr>`;
            });

            $('tbody').html(html);

        }
    });
</script>
@endsection