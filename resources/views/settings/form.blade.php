@include('flash::message')

<div class="form-group">
    {!! Form::label('About App') !!}
    {!! Form::text('about_app',old('name'),['class' => 'form-control']) !!}

</div>


<div class="form-group">
    {!! Form::label('Commission') !!}
    {!! Form::text('commission',old('name'),['class' => 'form-control']) !!}

</div>

<div class="form-group">
  {!! Form::submit('save', ['class' => 'btn btn-primary']) !!}
</div>
