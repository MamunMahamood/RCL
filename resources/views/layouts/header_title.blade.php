<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{$header_left}}</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a class="btn btn-primary" href="{{route($header_right_route)}}">{{$header_right}}</a></li>
         
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
    @include('layouts._massage')
  </div><!-- /.container-fluid -->
</div>