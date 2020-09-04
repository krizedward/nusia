@extends('layouts.admin.default')

@section('title','Student | Payment')

@include('layouts.css_and_js.table')

@section('content')
    <!-- Main content -->
    <section class="invoice">
        @foreach($data as $dt)
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Nusantara Indonesia
                    <small class="pull-right">Date: {{ $dt->created_at }}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Course</th>
                        <th>Description</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $dt->code }}</td>
                        <td>{{ $dt->course_registration->course->title }}</td>
                        <td>El snort testosterone trophy driving gloves handsome</td>
                        <td>${{ $dt->amount }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">Payment Methods:</p>
                <img src="../../dist/img/credit/visa.png" alt="Visa">
                <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                <img src="../../dist/img/credit/american-express.png" alt="American Express">
                <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Amount Due 2/22/2014</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Total:</th>
                            <td>${{ $dt->amount }}</td>
                        </tr>
                        <tr>
                            <th>Tax (10%)</th>
                            <td>${{ $tax = $dt->amount*(10/100) }}</td>
                        </tr>
                        <tr>
                            <th>Subtotal:</th>
                            <td>${{ $dt->amount+$tax }}</td>
                        </tr>
                        {{--
                        <tr>
                            <th>Shipping:</th>
                            <td>$5.80</td>
                        </tr>
                        --}}
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                {{--
                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                 <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                </button>
                <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                </button>--}}
                <a href="{{ route('instructors.private') }}" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</a>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
    @endforeach
@stop
