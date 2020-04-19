
@include('flash::message')
@inject('restaurant','App\Models\Restaurant')


<div class="form-group">
    {!! Form::label('Name') !!}
    {!! Form::text('name',old('name'),['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('description') !!}
    {!! Form::textarea('description',old('description'),['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Price') !!}
    {!! Form::text('price',old('price'),['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('Price offer') !!}
    {!! Form::text('price_offer',old('price_offer'),['class' => 'form-control']) !!}
</div>


<div class="form-group">
    <div class="form-group">
        {{ Form::label('restaurant') }}
        {{ Form::select('restaurant_id', $restaurant->pluck('name','id'), null, ['class'=>'form-control', 'placeholder'=>'Please select ...']) }}
    </div>
</div>


<div class="form-group">
    {!! Form::label('Image') !!}
    {!! Form::file('photo',old('photo'),null,['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::submit('save', ['class' => 'btn btn-primary']) !!}
</div>
