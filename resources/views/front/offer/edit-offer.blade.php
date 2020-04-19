@extends('front.layouts.app')
@section('title','Edit product')
@inject('restaurant','App\Models\Restaurant)

@section('content')
    <section class="add-new-section product">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <h1 class="text-center form-title">اضف منتج جديد</h1>
                    <form action="{{ route('update.offer', $offer->id) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @include('flash::message')
                        @include('includes.errors')
                        <div class="img-input">
                            <div class="img">
                                <img src="{{ asset('front/images') }}/default-image.jpg" alt="">
                                <input  type="file" name="photo" id="offer_image">
                            </div>
                            <p>صورة العرض</p>
                        </div>
                        <div class="input-group">
                            <input type="text" value="{{ $offer->name }}" placeholder="اسم العرض" id="offer-name" required name="name">
                            <textarea name="description" id="offer-short-description" placeholder="وصف مختصر"> {{ $offer->description }}</textarea>
                            <input type="text" value="{{ $offer->price }}"  placeholder="سعر العرض" id="offer-price" name="price">
                        </div>
                        <select name="restaurant_id"  class="form-control">
                            <option selected> اختر المطعم</option>
                            @foreach($restaurant->get() as $rest)
                                <option value="{{ $rest->id }}" {{ $rest->id === $offer->restaurant_id ? 'selected' : '' }}> {{ $rest->name }}</option>
                            @endforeach
                        </select>
                        <br>
                        <div class="input-group d-flex date">
                            <div>
                                <input type="date" class="from" value="{{ $offer->start }}" name="start" placeholder="من"/>
                            </div>
                            <div>
                                <input type="date" class="to" value="{{ $offer->end }}" name="end" placeholder="الى"/>
                            </div>
                        </div>

                        <input type="submit" class="add-new-link" value="اضافة">
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
