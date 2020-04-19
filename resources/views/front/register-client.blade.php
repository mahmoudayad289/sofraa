@extends('front.layouts.app')
@section('title','Register Client')
@inject('city',''App\Models\City')
@inject('district',''App\Models\District')

@section('content')

    <!-- start talabaty section -->
    <div class="container">
        <section class=" register-page py-5 my-5">
            <div class="reg1 mx-auto my-5">
                <div><img src="{{ asset('front/images') }}/use-img.png" alt="user"></div>

                <form method="post" action="{{ route('do.register.client') }}" class="p-5 my-3 text-center">
                    @csrf
                    @include('flash::message')
                    @include('includes.errors')
                    <input type="text" name="name" class="form-control my-4" placeholder="الاسم">
                    <input type="email" name="email" class="form-control my-4" placeholder="البريد الاليكترونى">
                    <input type="text" name="phone" class="form-control my-4" placeholder="الجوال">

                    <select name="city_id" class="form-control">
                        <option selected> اختر المدينه</option>
                        @foreach($city->get() as $cities)
                            <option value="{{ $cities->id }}"> {{ $cities->name }}</option>
                        @endforeach
                    </select>
                    <br>
                    <select name="district_id" class="form-control">
                        <option selected> اختر المدينه</option>
                        @foreach($district->get() as $districts)
                            <option value="{{ $districts->id }}"> {{ $districts->name }}</option>
                        @endforeach
                    </select>
                    <input type="password" name="password" class="form-control my-4" placeholder="كلمة المرور">
                    <input type="password" name="password_confirmation" class="form-control my-4" placeholder="اعادة كلمة المرور">
                    <div class="form-row">
                        <div class="col new-user">
                            <p>  بإنشاء حسابك أن توافق على <a href=""> شروط الاستخدام </a> الخاصة بسفرة</p>
                        </div>
                    </div>
                    <button type="submit" class="btn w-75 mt-4 text-white">دخول</button>
                </form>
            </div>
        </section>
    </div>

@endsection
