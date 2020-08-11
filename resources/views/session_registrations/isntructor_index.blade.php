@extends('layouts.admin.default')

@section('title','Instructor | Schedule')

@include('layouts.css_and_js.table')

{{--Session di Sidebar--}}
@section('content-header')
    <h1>Session</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="active">Free Trial</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Link Zoom Session</h3>
                </div>
                <div class="box-body">
                    <form action="#" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Session In</label>
                            <select class="form-control select2" name="user">
                                <option selected="" disabled="">Session In</option>
                                <option>[kode] - Free Trial Course</option>
                                <option>[kode] - Novice-Low Private</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Link Zoom</label>
                            <input type="text" name="name" class="form-control" placeholder="Link Zoom.." value="{{ old('name') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <!-- Session-Course Reminder -->
            <div class="box box-warning">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width: 100px">Session ID</th>
                            <th>Course Level</th>
                            <th>Course Type</th>
                            <th>Date Meet</th>
                            <th>Status</th>
                            <th style="width: 40px">Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>FR001</td>
                            <td>Free</td>
                            <td>Trial</td>
                            <td>20 August 2020</td>
                            <td>No Link</td>
                            <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Detail</a></td>
                        </tr>
                        <tr>
                            <td>FR002</td>
                            <td>Free</td>
                            <td>Trial</td>
                            <td>20 August 2020</td>
                            <td>No Link</td>
                            <td><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs btn-success" href="#">Detail</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@stop
