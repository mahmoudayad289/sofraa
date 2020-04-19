@extends('layouts.app')
@section('title','Change pass')
@inject('model','App\User')
@section('content')
@section('title_page','Dashboard')
@section('small_title','Create User')

<section class="content">
    <!-- /.card-body -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Change pass</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>

        <div class="card-body">


            @include('includes.errors')



            {!! Form::model($model, ['route' => 'change.pass.save']) !!}


            <div class="form-group">
                <label for="">Old Password</label>
                <input type="password" name="old-password" class="form-control" value="{{ $model->password }}">
            </div>

            <div class="form-group">
                <label for=""> New Password</label>
                <input type="password" name="password" class="form-control" value="{{ $model->password }}">
            </div>

            <div class="form-group">
                <label for=""> New Password</label>
                <input type="password" name="password_confirmation"  class="form-control" value="{{ $model->password }}">
            </div>


            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary ']) !!}
            </div>

            {!! Form::close() !!}

        </div>
    </div>

    <!-- /.card-body -->
</section>
@endsection


