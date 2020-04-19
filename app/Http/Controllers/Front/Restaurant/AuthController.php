<?php

namespace App\Http\Controllers\Front\Restaurant;

use App\Http\Requests\RestaurantFormRequest;
use App\Mail\ResetRestaurantPassword;
use App\Models\Restaurant;
use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{


    // ==========================   show Register Restaurant    ============================= //


    public function showRegisterRestaurant()
    {
        return view('front.register-restaurants');
        
    }

    // ==========================   show Register Restaurant    ============================= //


    public function doRegisterRestaurant(RestaurantFormRequest $request)
    {

        $request->validated();

        if($request->hasFile('image')) {

        Image::make($request->image)->resize(300, null, function ($constraint) {

            $constraint->aspectRatio();

        })->save(public_path('/images/restaurant/'. $request->image->hashName() ));
    }



        $restaurant = Restaurant::create($request->all());

        $restaurant->password = bcrypt($request->password);

        $restaurant->api_token = Str::random(60);
        $restaurant->image = $request->image->hashName();

        $restaurant->pin_code = Str::random(6);


        $restaurant->save();

        flash('تمت التسجيل بنجاح')->success();


        return redirect(route('front.home'));

   }


    // ==========================   show Register Restaurant    ============================= //


   public function showLoginRestaurant()
   {
       return view('front.login-restaurant');
   }

    // ==========================   show Register Restaurant    ============================= //


    public function doLoginRestaurant(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);


        $restaurant = Restaurant::where('phone',$request->phone)->first();


        if (auth()->guard('front_restaurant')->attempt($request->only('phone','password')) ) {

            flash('تمت التسجيل بنجاح')->success();

            return redirect(route('show.restaurant', $restaurant->id));
        } else {

            flash('  فشل تسجبل الدخول')->error();

            return redirect(route('do.login.restaurant'));
        }
   }


    // ==========================   show Register Restaurant    ============================= //


    public function logoutRestaurant()
    {
        auth()->guard('front_restaurant')->logout();

        return redirect(route('do.login.restaurant'));

    }

    // ==========================   show Register Restaurant    ============================= //


    public function ShowResetPasswordRestaurant()
    {
        return view('front.show-reset-pass-rest');
    }


    public function ShowNewPasswordRestaurant()
    {
        return view('front.show-new-pass-rest');
    }





    public function resetPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $rest = Restaurant::where('phone',$request->phone)->first();

        if ($rest) {

            $code = Str::random(6);

            $update =   $rest->update(['pin_code' => $code]);

           if ($update) {

               Mail::to($rest->email)
                   ->bcc('mahmoudayad289@gmail.com')
                   ->send(new ResetRestaurantPassword($code));


               flash('برجاء فحص الايميل الخاص بك')->success();


             return view('front.show-new-pass-rest');

           } else {

               flash('حدث خطا في البيانات')->error();

               return view('front.show-reset-pass-rest');

           }


        } else {

            flash('رقم الهاتف غير موجود')->error();
        }
    }


    public function newPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric',
            'pin_code' => 'required',
            'password' => 'required|min:6',
        ]);



        $rest = Restaurant::where('phone' , $request->phone)->where('pin_code', $request->pin_code)->first();


        if ($rest) {

            $rest->password = bcrypt($request->password);

            if ($rest->save()) {


                flash('تم تغير كلمه السر بناجاح')->success();

                return redirect(route('front.home'));

            } else {

                flash('حدث خطا في البيانات')->error();
            }

        } else {

            flash('حدث خطا في البيانات')->error();

        }


    }





}
