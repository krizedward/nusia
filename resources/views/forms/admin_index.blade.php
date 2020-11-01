@extends('layouts.admin.default')

@section('title','Admin | Forms')

@include('layouts.css_and_js.table')

@section('content-header')
<h1>Forms</h1>
@stop

@section('content')
  <div class="row">
    <div class="col-md-6">
      <!-- Form -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Form</h3>
        </div>
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <th>#</th>
              <th>title</th>
              <th>description</th>
              <th>action</th>
            </tr>
            <tr>
              <td>1</td>
              <td>example</td>
              <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua.</td>
              <td>No</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- End -->

      <!-- Form Response Detail -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Form Response Detail</h3>
        </div>

        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <th>#</th>
              <th>ID</th>
              <th>Answer</th>
            </tr>
            <tr>
              <td>1</td>
              <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua.</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- End -->

      <!-- Form Question Choice -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Form Question Choice</h3>
        </div>

        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <th>#</th>
              <th>ID</th>
              <th>Answer</th>
            </tr>
            <tr>
              <td>1</td>
              <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua.</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- End -->
    </div>
    <div class="col-md-6">
      <!-- Form Respone -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Form Respone</h3>
        </div>
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <th>#</th>
              <th>title</th>
              <th>description</th>
              <th>action</th>
            </tr>
            <tr>
              <td>1</td>
              <td>example</td>
              <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua.</td>
              <td>No</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- End -->

      <!-- Form Question -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Form Question</h3>
        </div>
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <th>#</th>
              <th>title</th>
              <th>description</th>
              <th>action</th>
            </tr>
            <tr>
              <td>1</td>
              <td>example</td>
              <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua.</td>
              <td>No</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- End -->
    </div>
  </div>
@stop