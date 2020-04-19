@extends('front.layouts.app')
@section('title','offers')

@section('content')
    <!-- Start Offers Section -->

    <section class="offers">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>العروض المتاحه الان</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="{{ route('offer.form') }}" class="btn minu-btn my-5 px-5">اضف عرضا جديداً</a>
                </div>
            </div>
            <div class="row">
                @foreach($offers as $offer)
                <div class="col-sm-4" style="margin-bottom:10px;">
                    <div class="card text-center" style="width: 18rem;">
                        <img class="card-img-top" src="{{ $offer->image_path }}" alt="Card image cap" height="200px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $offer->name }} </h5>
                            <p class="card-text">{{ $offer->description }}</p>
                            <p class="btn btn-primary">{{ $offer->price }}</p>
                            <a href="{{ route('edit.offer',$offer->id) }}" class="btn btn-primary">تعديل</a>
                        </div>
                    </div>
                </div>
               @endforeach
            </div>
        </div>
    </section>

    <!-- Start Offers Section -->
@endsection
