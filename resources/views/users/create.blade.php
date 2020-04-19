@extends('layouts.app')
@section('title','Create User')
@inject('model','App\User')
@section('content')
@section('title_page','Dashboard')
@section('small_title','Create User')

<section class="content">
    <!-- /.card-body -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User Create</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>

        <div class="card-body">


            @include('includes.errors')



            {!! Form::model($model, ['route' => 'users.store']) !!}

            @include('users.form')

            {!! Form::label('password') !!}
            {!! Form::password('password',['class' => 'form-control']) !!}


            {!! Form::label('Confirm password') !!}
            {!! Form::password('password_confirmation',['class' => 'form-control']) !!}




            <br>

            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary ']) !!}
            </div>

            {!! Form::close() !!}

        </div>
    </div>

    <!-- /.card-body -->
</section>
@endsection


