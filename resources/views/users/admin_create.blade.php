@extends('layouts.admin.default')

@section('title', 'Admin | User | Create')

@include('layouts.css_and_js.table')

@section('content-header')
  <h1><b>Create User Form</b></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="callout callout-info">
                <h4>Tip!</h4>

                <p>Roles: financial_team, customer_service, lead_instructor, instructor, student</p>
                <p>Melihat daftar user dalam role masing-masing (tampilan dipisah untuk daftar Financial Team, CS Team, Lead Instructor, Instructor, dan Student dengan status registrasi masing-masing). Termasuk, melihat profil masing-masing.</p>
            </div>
        </div>    
    </div>

    <div class="row">
        <div class="col-md-6">
           <div class="box with-border">
               <div class="box-header">
                   <div class="box-title">Form Create User</div>
               </div>
               <form role="form" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
               @csrf
               <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <!-- First Name -->
                        <div class="form-group @error('first_name') has-error @enderror">
                            <label for="first_name">First Name</label>
                            <input name="first_name" type="text" class="@error('first_name') is-invalid @enderror form-control" placeholder="Enter First Name">
                            @error('first_name')
                            <p style="color:red">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Last Name -->
                        <div class="form-group @error('last_name') has-error @enderror">
                            <label for="last_name">Last Name</label>
                            <input name="last_name" type="text" class="@error('last_name') is-invalid @enderror form-control" placeholder="Enter Last Name">
                            @error('last_name')
                            <p style="color:red">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- <div class="form-group">
                            <label>Email</label>
                            <input name="email" type="text" class="form-control">
                        </div> -->  
                    </div>
                    <div class="col-md-6">
                        <!-- Roles -->
                        <input type="hidden" name="roles" value="Student">
                        <div class="form-group">
                          <label>Select</label>
                          <select class="form-control" name="roles">
                            <option value="Student">Student</option>
                            <option value="Instructor">Instructor</option>
                            <option value="Lead Instructor">Lead Instructor</option>
                            <option value="Customer Service">Customer Service</option>
                            <option value="Financial Team">Financial Team</option>
                          </select>
                        </div>
                        <!-- Email -->
                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="@error('email') is-invalid @enderror form-control" placeholder="Enter Email">
                            @error('email')
                            <p style="color:red">{{ $message }}</p>
                            @enderror
                        </div>  
                    </div>
                </div>
               </div>

               <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
               </div>
               </form>
           </div> 
        </div>

        <div class="col-md-6">
           <div class="box with-border">
               <div class="box-header">
                   <div class="box-title">Table User</div>
               </div>

               <div class="box-body">
                   <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    @foreach($user as $dt)
                    <tr>
                      <td>{{ $dt->id }}</td>
                      <td>{{ $dt->first_name }} {{ $dt->last_name }}</td>
                      <td>{{ $dt->roles }}</td>
                      <td class="text-center"><a target="_blank" rel="noopener noreferrer" class="btn btn-flat btn-xs bg-blue" href="{{ route('users.show', [Str::slug($dt->password.$dt->first_name.'-'.$dt->last_name)]) }}">Detail</a></td>
                    </tr>
                    @endforeach
                  </table>
               </div>

               <div class="box-footer">
                    <div class="pull-right">
                        {{ $user->links() }}
                    </div>
               </div>
           </div> 
        </div>
        <!-- <div class="col-md-12">
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
        </div> -->
    </div>
@stop
