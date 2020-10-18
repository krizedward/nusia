@extends('layouts.admin.default')

@section('title', 'Admin | User | Create')

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>Create User Form</b></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Form</h3>
                </div>
                <form role="form" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input name="" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <input name="" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Citizenship</label>
                                <input name="" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Domicile</label>
                                <input name="" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Timezone</label>
                                <input name="" type="text" class="form-control">
                            </div>
                            {{--
                            <div class="form-group">
                                <label>Session</label>
                                <select name="session_id" class="form-control select2">
                                    <option selected="" disabled="">Choose Session</option>
                                    @foreach($session as $dt)
                                        <option value="{{ $dt->id }}">{{ $dt->id }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input name="" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input name="" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input name="" type="text" class="form-control">
                            </div>
                            {{--
                            <div class="form-group">
                                <label>Course</label>
                                <select name="course_id" class="form-control select2">
                                    <option selected="" disabled="">Choose Course</option>
                                    @foreach($course_registration as $dt)
                                        <option value="{{ $dt->id }}">{{ $dt->id }}</option>
                                    @endforeach
                                </select>
                            </div>--}}
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                </form>
            </div>
        </div>
    </div>
@stop
