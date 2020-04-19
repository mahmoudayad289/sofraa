@include('flash::message')
@inject('city','App\Models\City')
@inject('district','App\Models\District')

<div class="form-group">
    {!! Form::label('Name') !!}
    {!! Form::text('name',old('name'),['class' => 'form-control', 'required' => true]) !!}

</div>


<div class="form-group">
    {!! Form::label('Email') !!}
    {!! Form::email('email',old('email'),['class' => 'form-control', 'required' => true]) !!}

</div>

<div class="form-group">
    {!! Form::label('Phone') !!}
    {!! Form::text('phone',old('phone'),['class' => 'form-control', 'required' => true]) !!}

</div>

<div class="form-group">
    {!! Form::label('Image') !!}
    {!! Form::file('image',old('image'),null,['class' => 'form-control']) !!}

</div>

<div class="form-group">
    <div class="form-group">
        {{ Form::label('Select City') }}
        {{ Form::select('city_id', $city->pluck('name','id'), null, ['class'=>'form-control', 'placeholder'=>'Please select ...']) }}
    </div>
</div>


<div class="form-group">
    <div class="form-group">
        {{ Form::label('Select District') }}
        {{ Form::select('district_id', $district->pluck('name','id'), null, ['class'=>'form-control', 'placeholder'=>'Please select ...']) }}
    </div>
</div>


<div class="form-group">
    {!! Form::label('Password') !!}
    {!! Form::password('password',['class' => 'form-control', 'required' => true]) !!}

</div>



<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary ']) !!}
</div>
