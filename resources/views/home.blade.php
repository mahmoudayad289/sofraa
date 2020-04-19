@extends('layouts.app')
@section('title','Dashboard')
@inject('clients',App\Models\Client')

@section('content')
@section('small_title','Dashboard')
<section class="content">
    <div class="container-fluid">
{{--        <!-- Small boxes (Stat box) -->--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-3 col-sm-6 col-6">--}}
{{--                <div class="info-box">--}}
{{--                    <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>--}}

{{--                    <div class="info-box-content">--}}
{{--                        <span class="info-box-text">Clients</span>--}}
{{--                        <span class="info-box-number">{{ $clients->count() }}</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box-content -->--}}
{{--                </div>--}}
{{--                <!-- /.info-box -->--}}
{{--            </div>--}}
{{--            <!-- /.col -->--}}
{{--            <div class="col-md-3 col-sm-6 col-6">--}}
{{--                <div class="info-box">--}}
{{--                    <span class="info-box-icon bg-success"><i class="fa fa-sticky-note"></i></span>--}}

{{--                    <div class="info-box-content">--}}
{{--                        <span class="info-box-text">Posts</span>--}}
{{--                        <span class="info-box-number">{{ $posts->count() }}</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box-content -->--}}
{{--                </div>--}}
{{--                <!-- /.info-box -->--}}
{{--            </div>--}}
{{--            <!-- /.col -->--}}
{{--            <div class="col-md-3 col-sm-6 col-6">--}}
{{--                <div class="info-box">--}}
{{--                    <span class="info-box-icon bg-warning"><i class="fa fa-chart-line"></i></span>--}}

{{--                    <div class="info-box-content">--}}
{{--                        <span class="info-box-text">Donation requests</span>--}}
{{--                        <span class="info-box-number">{{ $donation_requests->count() }}</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box-content -->--}}
{{--                </div>--}}
{{--                <!-- /.info-box -->--}}
{{--            </div>--}}
{{--            <!-- /.col -->--}}
{{--            <div class="col-md-3 col-sm-6 col-6">--}}
{{--                <div class="info-box">--}}
{{--                    <span class="info-box-icon bg-danger"><i class="far fa-building"></i></span>--}}

{{--                    <div class="info-box-content">--}}
{{--                        <span class="info-box-text">Governorates</span>--}}
{{--                        <span class="info-box-number">{{ $governorates->count() }}</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box-content -->--}}
{{--                </div>--}}
{{--                <!-- /.info-box -->--}}
{{--            </div>--}}
{{--            <!-- /.col -->--}}
{{--        </div>--}}
{{--        <!-- /.row -->--}}

    </div><!-- /.container-fluid -->
</section>
@endsection


