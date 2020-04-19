@include('flash::message')


<div class="form-group">
    {!! Form::label('Name') !!}
    {!! Form::text('name',old('name'),['class' => 'form-control']) !!}

</div>


<div class="form-group">
    {!! Form::label('Email') !!}
    {!! Form::email('email',old('email'),['class' => 'form-control']) !!}

</div>


{{--<div class="form-group">--}}
{{--    {!! Form::label('Add Role') !!}--}}
{{--    {!! Form::select('role_list' ,[null => 'Select Role'] + $roles,null,['class' => 'form-control custom-select']) !!}--}}

{{--</div>--}}





