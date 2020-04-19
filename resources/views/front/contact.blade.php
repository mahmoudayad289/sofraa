@extends('front.layouts.app')
@section('title','Contact')


@section('content')

    <!-- Start Contact Section-->
    <section class="contact-us">
        <div class="container">
            <form action="{{ route('contact.us') }}" method="post" class="contact-info">
                @csrf
                @include('flash::message')
                @include('includes.errors')
                <h1 class="text-center form-title">تواصل معنا</h1>
                <div class="input-group">
                    <input type="text" required placeholder="الاسم" id="offer-name" name="name">
                    <input type="text" required placeholder="البريد" id="email" name="email">
                    <input type="text" required placeholder="الجوال" id="phone" name="phone">
                    <textarea required name="message" id="msg" rows="10" placeholder="ما هي رسالتك"></textarea>
                </div>
                <div class="input-group buttons">
                    <label class="d-flex flex-row"><span>شكوى</span> <input class="w-auto ml-2" type="radio" value="شكوى" name="type"></label>
                    <label class="d-flex flex-row"><span>اقتراح</span> <input class="w-auto ml-2" type="radio" value="اقتراح" name="type"></label>
                    <label class="d-flex flex-row"><span>استعلام</span> <input class="w-auto ml-2" type="radio" value="استعلام" name="type"></label>
                </div>
                <button type="submit" class="add-new-link"> اضافة</button>
            </form>
        </div>
    </section>

    <!-- Start Contact Section-->

@endsection
