@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">admins Table</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>admin Name</th>
                    <th>Action</th>
                    <!-- <th style="width: 40px">Label</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $index=>$admin)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$admin->name}}</td>
                    <td>
                        <div>
                        <a class="badge badge-primary" href="">Edit</a> |
                        <a class="badge badge-danger" href="">delete</a>
                        </div>
                    </td>
                    <!-- <td><span class="badge bg-danger">55%</span></td> -->
                </tr>
                @endforeach
            </tbody>
        </table>
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