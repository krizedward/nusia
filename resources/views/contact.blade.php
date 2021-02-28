@extends('layouts.admin.default')

@section('title','Contact Us')

@include('layouts.css_and_js.dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success alert-dismissable">
            <h4>
                <i class="icon fa fa-comments"></i>
                Contact Us!
            </h4>
            Have a question? Please feel free to send us an email on <a href="mailto:nusia.helpdesk@gmail.com">nusia.helpdesk@gmail.com</a>.
        </div>
    </div>
</div>
@stop
