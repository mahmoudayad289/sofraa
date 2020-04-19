@extends('front.layouts.app')
@section('title','Register Client')


@section('content')

    <!-- start talabaty section -->
    <div class="container">
        <section class=" register-page py-5 my-5">
            <div class="reg mx-auto my-5">
                <div><img src="{{ asset('front/images') }}/use-img.png" alt="user"></div>
                <form action="{{ route('do.login.client') }}" method="post" class="p-5 my-3 text-center">
                    @csrf
                    @include('flash::message')
                    @include('includes.errors')

                    <input type="text" name="phone" class="form-control my-4" placeholder=" رقم الهاتف">
                    <input type="password" name="password" class="form-control my-4" placeholder="كلمه السر">
                    <button type="submit" class="btn w-75 my-4 text-white">دخول</button>

                    <div class="form-row my-3">
                        <div class="col new-user">
                            <a href="{{ route('show.register.client') }}">مستخدم جديد ؟</a>
                        </div>
                        <div class="col pass">
                            <a href="{{ route('show.reset.password.client') }}">نسيت كلمة السر ؟</a>
                        </div>
                    </div>
                    <button type="submit" class="btn w-75 my-4 text-white">انشيء حساب الآن</button>
                </form>
            </div>
        </section>
    </div>

@endsection
