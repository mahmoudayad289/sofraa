@extends('front.layouts.app')
@section('title','Register Client')
@inject('city',''App\Models\City')
@inject('district',''App\Models\District')

@section('content')

    <!--==============First section=======-->
    <section id="header">
        <div class="container">
            <div class="header-desc">
                <img class="website-name" src="images/res-img.png" alt="" style="margin: 0 auto;">
                <h1 class="res-name">{{ $record->name }}</h1>
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
                @if (count($record->products))

                @foreach($record->products as $pro)
                <div class="col-sm-4">
                    <div class="item-holder">
                        <img src="{{ $pro->image_path }}" alt="item-image" width="100%">
                        <div class="item-data text-center">
                            <h3 class="item-title">{{ $pro->name }}</h3>
                            <p class="item-description">{{ $pro->description }}</p>
                        </div>
                        <div class="features">
                            <div>
                                <img src="{{ asset('front/images') }}/piggy-bank.png" alt="" width="30px;">
                                <span class="delevery-time">
                                    30 دقيقة تقريبا
                                </span>
                            </div>
                            <div>
                                <img src="{{ asset('front/images') }}/piggy-bank.png" alt="" width="30px;">
                                <span class="delevery-time">
                                   {{ $pro->price }}
                                </span>
                            </div>
                            <a href="{{ route('show.product',$pro->id) }}" class="d-block">   تفاصيل المنتج</a>
                        </div>
                    </div>
                </div>
                @endforeach

                    @else

                    <div class="alert alert-light">
                        No Products
                    </div>

                @endif
            </div>
        </div>
    </section>


@endsection
