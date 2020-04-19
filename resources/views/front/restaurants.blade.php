@extends('front.layouts.app')
@section('title','Restaurants')


@section('content')

    <!--==============First section=======-->
    <section id="header">
        <div class="container">
            <div class="header-desc">
                <img class="website-name" src="images/res-img.png" alt="" style="margin: 0 auto;">
                <h1 class="res-name"> المطاعم</h1>
                <ul class="list-unstyled">
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="food">
        <div class="container">
            <div class="row">
                @foreach($restaurants as $rest)
                <div class="col-sm-4">
                    <div class="item-holder">
                        <img src="{{ $rest->image_path }}" alt="{{ $rest->name }}" width="100%" style="height: 200px;">
                        <div class="item-data text-center">
                            <h3 class="item-title">{{ $rest->name }}</h3>
                            <p class="item-description"> @if ($rest->state == 'open')  مفتوح@else مغلق @endif</p>
                        </div>
                        <div class="features">
                            <div>
                                <img src="{{ asset('front/images') }}/piggy-bank.png" alt="" width="30px;">
                                <span class="delevery-time">
                                    {{ $rest->delivery_charge }} سعر توصيل الطلب
                                </span>
                            </div>
                            <div>
                                <img src="{{ asset('front/images') }}/piggy-bank.png" alt="" width="30px;">
                                <span class="delevery-time">
                                     {{ $rest->minimum_order }} اقل سعر للطلب
                                </span>
                            </div>
                            <a href="{{ route('show.restaurant',$rest->id) }}" class="d-block">اضغط للتفاصيل</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        {{ $restaurants->links() }}

    </section>

@endsection
