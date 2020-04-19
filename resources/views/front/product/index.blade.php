@extends('front.layouts.app')
@section('title','all product')

@section('content')
    <section class="food">
        <div class="container">
            <div class="row">
                @if (count($record))

                    @foreach($record as $pro)
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
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="{{ route('show.product',$pro->id) }}" class="d-block">   تفاصيل </a>

                                    </div>
                                    <div class="col-sm-6">
                                        <a href="{{ route('add.to.cart',$pro->id) }}" class="d-block">اضف للعربه  </a>

                                    </div>
                                </div>
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
            {{ $record->links() }}
        </div>
    </section>
@endsection
