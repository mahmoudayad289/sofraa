<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Mail\ResetPassword;
use App\Mail\ResetRestaurantPassword;
use App\Models\Restaurant;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;

class AuthController extends Controller
{

    // ==========================   register    ============================= //


    public function register(Request $request)
    {
        $validator =   Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|numeric',
            'password' => 'required',
            'district_id' => 'required|numeric|exists:districts,id',
            'delivery_charge' => 'required',
            'minimum_order' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }

        if($request->hasFile('image')) {

            Image::make($request->image)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('/images/restaurant/'. $request->image->hashName() ));

        }

        $restaurant = Restaurant::create($request->all());

        $restaurant->password = bcrypt($request->password);

        $restaurant->categories()->attach($request->category_id);

        $restaurant->api_token = Str::random(60);
        $restaurant->pin_code = Str::random(6);

        $restaurant->save();

        return responseJson('1' , 'success',[
            'api_token' => $restaurant->api_token,
            'client' => $restaurant,
        ]);

    }

    // ==========================   login    ============================= //

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'phone' => 'required|numeric',
            'password' => 'required',
        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }

        $restaurant = Restaurant::where('phone', $request->phone)->first();


        if ($restaurant) {

            if(Hash::check($request->password, $restaurant->password)) {

                return responseJson('1','تم تسجيل الدخول بنجاح',[
                    'api_token' => $restaurant->api_token,
                    'restaurant' => $restaurant,
                ]);

            } else {

                return responseJson('0','تأكد من البيانات واعد المحاوله');

            }

        } else {

            return responseJson('0','بيانات التسجيل غير صحيحه');
        }
    }

    // ==========================   reset password    ============================= //


    public function resetPassword(Request $request)
    {

        $validator = Validator::make($request->all(),[

            'phone' => 'required|numeric',
        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }


        $restaurant = Restaurant::where('phone',$request->phone)->first();


        if ($restaurant) {

            $code = Str::random(6);

          $update =   $restaurant->update(['pin_code' => $code]);


            if($update) {
                Mail::to($restaurant->email)
                    ->bcc('mahmoudayad289@gmail.com')
                    ->send(new ResetRestaurantPassword($code));

                return responseJson('0','برجاء فحص الايميل الخاص بك');

            } else {

                return responseJson('0','حدث خطا في البيانات');

            }

        } else {

            return responseJson('0','رقم الهاتف غير موجود');
        }
    }

    // ==========================   new password    ============================= //


    public function newPassword(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'phone' => 'required|numeric',
            'password' => 'required',
            'pin_code' => 'required',
        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }


        $restaurant = Restaurant::where('pin_code' , $request->pin_code)->where('pin_code' ,'!=','')->where('phone',$request->phone)->first();


        if ($restaurant) {


            $restaurant->password = bcrypt($request->password);

            $restaurant->pin_code = null;


            if ($restaurant->save()) {

                return responseJson('1','تم تغير كلمه السر بنجاح');

            } else {

                return responseJson('0','حدث خطا في البيانات');

            }

        } else {

            return responseJson('0','بيانات التسجيل غير صحيحه');
        }

    }


    // ==========================   profile    ============================= //


    public function profile(Request $request)
    {
        $profile = $request->user();

        return responseJson('1','success',$profile);

    }


    // ==========================  edit profile    ============================= //


    public function editProfile(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required|numeric|unique:restaurants,phone',
            'password' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'district_id' => 'required|exists:districts,id',
        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }



        $restaurant = $request->user();


        if($request->hasFile('image')) {

            Image::make($request->image)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('/images/restaurant/'. $request->image->hashName() ));

        }

        $restaurant->password = bcrypt($request->password);

        $restaurant->update($request->all());


        return responseJson('1','تم تحدث البيانات بنجاح',$restaurant);



    }

    // ==========================  register token     ============================= //


    public function registerToken(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);


        if ($validator->fails()) {

            return responseJson('0', $validator->errors()->first(), $validator->fails());
        }


       $token =  $request->user()->tokens()->create($request->all());


        if ($token) {

            return responseJson('1','success');

        } else {

            return responseJson('1','error to add token');

        }


    }

    // ==========================   remove token     ============================= //


    public function removeToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);


        if ($validator->fails()) {

            return responseJson('0', $validator->errors()->first(), $validator->fails());
        }


        $token = Token::where('token',$request->token)->delete();


        return responseJson('1','success delete');


    }


}
