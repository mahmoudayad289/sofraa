@include('flash::message')
@inject('restaurant','App\Models\Restaurant')
@inject('client','App\Models\Client')
@inject('product','App\Models\Product')


<div class="form-group">
    <div class="form-group">
        {{ Form::label('restaurant') }}
        {{ Form::select('restaurant_id', $restaurant->pluck('name','id'), null, ['class'=>'form-control', 'placeholder'=>'Please select restaurant']) }}
    </div>
</div>


<div class="form-group">
    <div class="form-group">
        {{ Form::label('Client') }}
        {{ Form::select('client_id', $client->pluck('name','id'), null, ['class'=>'form-control', 'placeholder'=>'Please select client']) }}
    </div>
</div>


<div class="form-group">
    <div class="form-group">
        {{ Form::label('Products') }}
        {{ Form::select('product_id', $product->pluck('name','id'), null, ['class'=>'form-control', 'placeholder'=>'Please select product']) }}
    </div>
</div>


<div class="form-group">
    {!! Form::label('Amount') !!}
    {!! Form::text('amount',old('amount'),['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('Notes') !!}
    {!! Form::textarea('notes',old('notes'),['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Address') !!}
    {!! Form::text('address',old('address'),['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('spacial order') !!}
    {!! Form::text('spacial_order',old('spacial_order'),['class' => 'form-control']) !!}
</div>


<div class="form-group">
    <div class="form-group">
        {{ Form::label('payment method') }}
        {{ Form::select('payment_method', ['online','cash'], null, ['class'=>'form-control', 'placeholder'=>'Payment method ...']) }}
    </div>
</div>


<div class="form-group">
    <div class="form-group">
        {{ Form::label('statue') }}
        {{ Form::select('statue',  ['pending','accepted', 'rejected', 'delivered', 'deleted'], null, ['class'=>'form-control', 'placeholder'=>'Select statue']) }}
    </div>
</div>


<div class="form-group">
    {!! Form::submit('save', ['class' => 'btn btn-primary']) !!}
</div>


