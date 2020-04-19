@include('flash::message')
@inject('district','App\Models\District')


<div class="form-group">
    {!! Form::label('Name') !!}
    {!! Form::text('name',old('name'),['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('Email') !!}
    {!! Form::email('email',old('name'),['class' => 'form-control']) !!}
</div>



<div class="form-group">
    {!! Form::label('phone') !!}
    {!! Form::text('phone',old('phone'),['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('delivery charge') !!}
    {!! Form::text('delivery_charge',old('delivery_charge'),['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('minimum charge') !!}
    {!! Form::text('minimum_order',old('minimum_order'),['class' => 'form-control']) !!}
</div>



<div class="form-group">
    <div class="form-group">
        {{ Form::label('state') }}
        {{ Form::select('state', ['open','close'], null, ['class'=>'form-control', 'placeholder'=>'Please select ...']) }}
    </div>
</div>


<div class="form-group">
    <div class="form-group">
        {{ Form::label('district') }}
        {{ Form::select('district_id', $district->pluck('name','id'), null, ['class'=>'form-control', 'placeholder'=>'Please select ...']) }}
    </div>
</div>


<div class="form-group">
    {!! Form::label('Image') !!}
    {!! Form::file('image',old('image'),null,['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('Password') !!}
    {!! Form::password('password',['class' => 'form-control', 'required' => true]) !!}
</div>

<div class="form-group">
    {!! Form::submit('save', ['class' => 'btn btn-primary']) !!}
</div>


