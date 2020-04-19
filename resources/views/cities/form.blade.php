@include('flash::message')

<div class="form-group">
    {!! Form::label('Name') !!}
    {!! Form::text('name',old('name'),['class' => 'form-control', 'id' => 'cityName']) !!}

</div>

<div class="form-group">
  {!! Form::submit('save', ['class' => 'btn btn-primary']) !!}
</div>
