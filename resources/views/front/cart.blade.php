@extends('front.layouts.app')
@section('title','Contact')


@section('content')

    <section class="cart">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <div class="cart-item">
                        @if (session('cart'))



                            @foreach(session('cart') as $details)
                        <div class="row">
                            <div class="col-sm-5">
                                <img src="" alt="">
                            </div>
                            <div class="col-sm-7">
                                <p></p>
                                <p>dfdfd</p>
                                <p>البائع : wild burger</p>
                                <p>dfdff <span>1</span></p>
                                <a href="#" class="add-new-link"><span class="cricle">X</span> امسح</a>
                            </div>
                        </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

