@extends('front.layouts.app')
@section('title','home')
@inject('city','App\Models\City')
@inject('restaurants','App\Models\Restaurant')
@section('content')

    <!-- Start Header Section -->
    <header class="text-center">
        <div class="container">
            <div class="header-content">
                <h1>سفرة</h1>
                <p>بتشتري...بتبيع؟ كله عند ام ربيع</p>
                <a class="register main-btn" href="{{ route('show.register.client') }}">
                    <span>سجل الأن</span>
                    <i class="fa fa-code"></i>
                </a>
            </div>
        </div>
    </header>
    <!-- End Header Section -->

    <!-- Start Favs Resturants Section -->
    <section class="favs text-center">
        <div class="container">
            <h2>ابحث عن مطعمك المفضل</h2>
            <form  method="get" action="{{ route('front.home') }}">
            <div class="row">
                <div class="col-md-5">
                    <div class="select-box">
                        <i class="fa fa-arrow-down"></i>
                        <select   class="form-control input-lg" name="district_id" id="">
                            <option selected  value="">اختر المنطقه</option>
                            @foreach($districts as $dis)
                                <option required value="{{ $dis->id }}">{{ $dis->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="select-box">
                        <i class="fa fa-search"></i>
                        <input type="search" placeholder="ابحث عن مطعمك " class="form-control input-lg" name="rest_search">
                    </div>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">ابحث   <i class="fa fa-search"></i> </button>
                </div>
            </div>
            </form>
            <div class="row">

                @if(count($restaurant))

            @foreach($restaurant as $rest)

                <div class="col-md-6">
                    <div class="box text-center">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ $rest->image_path }}" alt="Favs">
                            </div>
                            <div class="col-md-4">
                                <h3><a href="{{ route('show.restaurant',$rest->id) }}"> {{ $rest->name }}</a></h3>
                                <ul class="list-unstyled stars">
                                    <li class="active">
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li class="active">
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li class="active">
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                    </li>
                                </ul>
                                <p>  {{ $rest->minimum_order }} <span>20</span> ريال</p>
                                <p>  {{$rest->delivery_charge}} <span>10</span> ريال</p>
                            </div>
                            <div class="col-md-4">
                                <span class="status">{{ $rest->state }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
                    @else

                <div class="alert alert-danger">
                    Not Restaurant for this search
                </div>

                @endif
            </div>
        </div>
    </section>
    <!-- End Favs Resturants Section -->

    <!-- Start Featues Section -->
    <section class="feats text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <p>لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور
                            أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد
                            أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات .</p>
                        <a class="main-btn" href="#">
                            شاهد العروض
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="offers">
                        <img src="{{ asset('front/images') }}/Group 1036.png" alt="Offers">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Featues Section -->

    <!-- Start Download Section -->
    <section class="download">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('front/images') }}/app mockup.png" alt="Offers">
                </div>
                <div class="col-md-6">
                    <div class="card text-center">
                        <h2>قم بتحميل التطبيق الخاص بنا الان</h2>
                        <a class="main-btn" href="#">
                            <span>حمل الأن</span>
                            <i class="fa fa-arrow-down"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Download Section -->

    <!-- Start Footer Section
<footer>
    <div class="container">
        <div class="footer-desc">
            <div class="who-us">
                <i class="fa fa-pencil"></i>
                <h3>من نحن</h3>
            </div>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.<br> Nam enim voluptatibus ullam deleniti
                culpa accusamus <br> fugit doloremque blanditiis provident pariatur, maiores harum error<br> porro
                nihil quidem eligendi magnam sunt aut?</p>
            <ul class="list-unstyled links">
                <li>
                    <a href="#" class="fa fa-facebook-square"></a>
                </li>
                <li>
                    <a href="#" class="fa fa-twitter"></a>
                </li>
                <li>
                    <a href="#" class="fa fa-instagram"></a>
                </li>
            </ul>
        </div>
        <a href="index.html" class="footer-logo">
            <img src="{{ asset('front/images') }}/sofra logo-1.png" alt="Footer-logo">
        </a>
    </div>
</footer>
<End Footer Section -->

@endsection
