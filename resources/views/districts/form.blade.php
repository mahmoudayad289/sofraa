@include('flash::message')
@inject('city','App\Models\City')


<div class="form-group">
    {!! Form::label('Name') !!}
    {!! Form::text('name',old('name'),['class' => 'form-control']) !!}
</div>


<div class="form-group">
    <div class="form-group">
        {{ Form::label('Select City') }}
        {{ Form::select('city_id', $city->pluck('name','id'), null, ['class'=>'form-control', 'placeholder'=>'Please select ...']) }}
    </div>
</div>

<div class="form-group">
    {!! Form::submit('save', ['class' => 'btn btn-primary']) !!}
</div>
