@extends('front.layouts.app')
@section('title','Create Offer')
@inject('restaurant','App\Models\Restaurant)

@section('content')
    <section class="add-new-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <h1 class="text-center form-title">اضف عرض جديد</h1>
                    <form action="{{ route('create.offer') }}" method="post" enctype="multipart/form-data">
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
                            <input type="text" placeholder="اسم العرض" id="offer-name" required name="name">
                            <textarea name="description" id="offer-short-description" placeholder="وصف مختصر"></textarea>
                            <input type="text"  placeholder="سعر العرض" id="offer-price" name="price">
                        </div>
                        <select name="restaurant_id"  class="form-control">
                            <option selected> اختر المطعم</option>
                            @foreach($restaurant->get() as $rest)
                                <option value="{{ $rest->id }}"> {{ $rest->name }}</option>
                            @endforeach
                        </select>
                        <br>
                        <div class="input-group d-flex date">
                            <div>
                                <input type="date" class="from" name="start" placeholder="من"/>
                            </div>
                            <div>
                                <input type="date" class="to" name="end" placeholder="الى"/>
                            </div>
                        </div>

                        <input type="submit" class="add-new-link" value="اضافة">
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
