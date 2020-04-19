<?php

namespace App\Http\Controllers\Front\Client;

use App\Http\Requests\ClientFormRequest;
use App\Mail\ResetPassword;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function showRegisterClient()
    {
        return view('front.register-client');

    }

    public function doRegisterClient(ClientFormRequest $request)
    {

        $request->validated();


        $client = Client::create($request->all());

        $client->password = bcrypt($request->password);
        $client->api_token = Str::random(60);
        $client->pin_code = Str::random(6);
        $client->save();

        flash('تمت التسجيل بنجاح')->success();


        return redirect(route('front.home'));

    }


    public function showLoginClient()
    {

        return view('front.login-client');
    }


    public function doLoginClient(Request $request)
    {
        $this->validate($request,[
            'phone' => 'required',
            'password' => 'required',
        ]);


        $client = Client::where('phone',$request->phone)->first();


        if (auth()->guard('front_client')->attempt($request->only('phone','password'))) {

            flash('تمت التسجيل بنجاح')->success();

            return redirect('/');

        } else {
            flash('  فشل تسجبل الدخول')->error();

            return redirect(route('do.login.client'));
        }
    }


    public function logout()
    {
        auth()->guard('front_client')->logout();

        return redirect(route('do.login.client'));
    }




    // ==========================   show Register Restaurant    ============================= //


    public function logoutClient()
    {
        auth()->guard('front_client')->logout();

        return redirect(route('do.login.client'));

    }

    // ==========================   show Register Restaurant    ============================= //


    public function ShowResetPasswordClient()
    {
        return view('front.show-reset-pass-client');
    }


    public function ShowNewPasswordClient()
    {
        return view('front.show-new-pass-client');
    }





    public function resetPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $client = Client::where('phone',$request->phone)->first();

        if ($client) {

            $code = Str::random(6);

            $update =   $client->update(['pin_code' => $code]);

            if ($update) {

                Mail::to($client->email)
                    ->bcc('mahmoudayad289@gmail.com')
                    ->send(new ResetPassword($code));


                flash('برجاء فحص الايميل الخاص بك')->success();


                return view('front.show-new-pass-client');

            } else {

                flash('حدث خطا في البيانات')->error();

                return view('front.show-reset-pass-client');

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



        $client = Client::where('phone' , $request->phone)->where('pin_code', $request->pin_code)->first();


        if ($client) {

            $client->password = bcrypt($request->password);

            if ($client->save()) {


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
