@extends('layouts.admin.default')
@section('title','Instructor Index')
@include('layouts.css_and_js.table')
@section('content-header')
  <h1>Instructor</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Instructor</li>
  </ol>
@stop
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header">
          <a href="{{ route('instructors.create') }}" class="btn btn-flat btn-sm btn-primary">+ Add Instructor</a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Profile Image</th>
                <th>Interest</th>
                <th>Working Experience</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $dt)
                <tr>
                  <td>{{ $dt->user->first_name }} {{ $dt->user->last_name }}</td>
                  @if($dt->user->image_profile)
                    <td><img src="{{ asset('uploads/user.jpg') }}" style="width: 50px"></td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  @if($dt->interest)
                    <?php
                      $interest = explode(', ', $dt->interest);
                    ?>
                    <td>
                      @for($i = 0; $i < count($interest); $i = $i + 1)
                        {{ $i + 1 }}. {{ $interest[$i] }}
                        @if($i + 1 != count($interest))
                          <br>
                        @endif
                      @endfor
                    </td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  @if($dt->working_experience)
                    <?php
                      $working_experience = explode('|| ', $dt->working_experience);
                    ?>
                    <td>
                      @for($i = 0; $i < count($working_experience); $i = $i + 1)
                        {{ $working_experience[$i] }}
                        @if($i + 1 != count($working_experience))
                          <br>
                        @endif
                      @endfor
                    </td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  @if($dt->created_at)
                    <td>{{ $dt->created_at }} GMT+0</td>
                  @else
                    <td><i>Not Available</i></td>
                  @endif
                  <td>
                    <a class="btn btn-flat btn-xs btn-success" href="#">Detail</a>
                    <a class="btn btn-flat btn-xs btn-danger" href="#">Delete</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop
