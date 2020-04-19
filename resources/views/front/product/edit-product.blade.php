@extends('front.layouts.app')
@section('title','Edit product')
@inject('restaurant','App\Models\Restaurant)

@section('content')
    <section class="add-new-section product">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <h1 class="text-center form-title">اضف منتج جديد</h1>
                    <form action="{{ route('update.product', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('flash::message')
                        @include('includes.errors')
                        <div class="img-input">
                            <div class="img">
                                <img required src="{{ asset('front/images') }}/default-image.jpg" alt="">
                                <input type="file" name="photo" id="product_image">
                            </div>
                            <p>صورة المنتج</p>
                        </div>
                        <div class="input-group">
                            <input required type="text" value="{{ $product->name }}" placeholder="اسم المنتج" id="product-name" name="name">
                            <textarea required name="description" id="product-short-description" placeholder="وصف مختصر">{{ $product->description }}</textarea>
                            <input type="text" required value="{{ $product->price }}" placeholder="سعر المنتج" id="product-price" name="price">
                            <input type="text" required value="{{ $product->price_offer }}" placeholder="مدة التجهيز" id="product-price" name="price_offer">
                            <select name="restaurant_id"  class="form-control">
                                <option selected> اختر المطعم</option>
                                @foreach($restaurant->get() as $rest)
                                    <option value="{{ $rest->id }}" {{ $rest->id === $product->restaurant_id ? 'selected' : '' }}> {{ $rest->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="add-new-link"> اضافة</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
