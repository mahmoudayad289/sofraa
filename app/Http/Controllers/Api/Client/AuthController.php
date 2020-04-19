<?php

namespace App\Http\Controllers\Api\Client;

use App\Mail\ResetPassword;
use App\Models\Client;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


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
            'city_id' => 'required|numeric|exists:cities,id',
            'district_id' => 'required|numeric|exists:districts,id',
        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }


        $client = Client::create($request->all());

        $client->password = bcrypt($request->password);
        $client->api_token = Str::random(60);
        $client->pin_code = Str::random(6);

        $client->save();


        return responseJson('1' , 'success',[
            'api_token' => $client->api_token,
            'client' => $client,
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

        $client = Client::where('phone', $request->phone)->first();


        if ($client) {

            if(Hash::check($request->password, $client->password)) {

                return responseJson('1','تم تسجيل الدخول بنجاح',[
                    'api_token' => $client->api_token,
                    'client' => $client,
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


        $client = Client::where('phone',$request->phone)->first();

        if ($client) {

            $code = str::random(6);

           $update =  $client->update(['pin_code' => $code]);


           if($update) {
               Mail::to($client->email)
                   ->bcc('mahmoudayad289@gmail.com')
                   ->send(new ResetPassword($code));

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


        $client = Client::where('pin_code' , $request->pin_code)->where('pin_code' ,'!=','')->where('phone',$request->phone)->first();


        if ($client) {


            $client->password = bcrypt($request->password);

            $client->pin_code = null;


            if ($client->save()) {

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
        $client = $request->user();

        return responseJson('1','success',$client);

    }


    public function editProfile(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:clients,email',
            'phone' => 'required|numeric',
            'password' => 'required',
            'district_id' => 'required|exists:districts,id',
        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }

        $client = $request->user();

        $client->password = bcrypt($request->password);

        $client->update($request->all());

        return responseJson('1','success',$client);

    }

    // ==========================   registerToken    ============================= //


    public function registerToken(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'token' => 'required',

        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }

        $token = $request->user()->tokens()->create($request->all());

        if ($token) {
            return responseJson('1','success');

        } else {

            return responseJson('0','faild token');

        }


    }

    // ==========================   removeToken    ============================= //


    public function removeToken(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'token' => 'required',

        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }

        $token = Token::where('token',$request->token)->delete();


        return responseJson('1','success deleted');

    }
    
}
