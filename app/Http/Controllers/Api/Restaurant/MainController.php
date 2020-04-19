<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Models\Category;
use App\Models\City;
use App\Models\District;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Profiler\Profile;

class MainController extends Controller
{

    // ==========================   districts    ============================= //

    public function districts(Request $request)
    {
        $district = District::where(function ($query) use ($request) {

            if ($request->has('city_id')) {

                $query->where('city_id',$request->city_id);

            }

        })->get();

        return responseJson('1','success',$district);

    }

    // ==========================   cities    ============================= //

    public function cities()
    {
       $cities = City::all();

        return responseJson('1','success',$cities);

    }

    // ==========================   settings    ============================= //

    public function settings()
    {
        $settings = Setting::all();

        return responseJson('1','success',$settings);

    }

    // ==========================   categories    ============================= //
    public function showCategories()
    {
        $categories = Category::all();

        return responseJson('1','success',$categories);
    }


    // ==========================   contacts    ============================= //


    public function contacts(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:clients,email',
            'phone' => 'required|numeric',
            'message' => 'required',
        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }


       $contact =  $request->user()->contacts()->create($request->all());

        return responseJson('1','success',$contact);

    }

    // ==========================   products    ============================= //

    public function products()
    {
        $products = Product::all();

        return responseJson('1','success',$products);

    }



    // ==========================  Create products    ============================= //


    public function CreateProduct(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }

        if($request->hasFile('photo')) {

            Image::make($request->photo)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('/images/restaurant/product'. $request->photo->hashName() ));

        }



        $product = $request->user()->products()->create($request->all());

        $product->restaurant_id = $request->user()->id;



        return responseJson('1','success',$product);

    }



    // ==========================  show products    ============================= //

    public function showProduct(Request $request)
    {

       $product = $request->user()->products()->where(function ($query) use ($request) {

           if($request->has('product_id')) {

               $query->where('id',$request->product_id);

           }

       })->get();


       if (count($product)) {
           return responseJson('1','success',$product);


       } else {
           return responseJson('0','المنتج غير موجود');

       }

    }



    // ==========================  edit products    ============================= //

    public function editProduct(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'product_id' => 'required|numeric|exists:products,id',
        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }


        $product = $request->user()->products()->find($request->product_id);


        if ($product) {

            $product->update($request->all());

            return responseJson('1','success update product', $product);


        } else {

            return responseJson('0','المنتج غير موجود');

        }

    }



    // ==========================  delete products    ============================= //

    public function deleteProduct(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'product_id' => 'required|numeric|exists:products,id',
        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }



        $product = $request->user()->products()->find($request->product_id);


        if($product) {

            $product->delete();

            return responseJson('1','success delete product');

        } else {

            return responseJson('0','المنتج غير موجود');

        }

    }




    // ==========================  offers    ============================= //


    public function offers()
    {
        $offers = Offer::all();

        return responseJson('1','success',$offers);

    }



    // ==========================  CreateOffer    ============================= //


    public function CreateOffer(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'description' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }

        if($request->hasFile('photo')) {

            Image::make($request->photo)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('/images/restaurant/offers'. $request->photo->hashName() ));

        }


       $offer =  $request->user()->offers()->create($request->all());

        $offer->restaurant_id =$request->user()->id;

        return responseJson('1','success',$offer);


    }


    // ==========================  showOffer    ============================= //


    public function showOffer(Request $request)
    {



        $offer = $request->user()->products()->where(function ($query) use ($request) {

            if($request->has('offer_id')) {

                $query->where('id',$request->offer_id);

            }

        })->get();


        if (count($offer)) {

            return responseJson('1','success',$offer);


        } else {

            return responseJson('0','العرض غير متاح');

        }


    }



    // ==========================  editOffer    ============================= //


    public function editOffer(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'offer_id' => 'required|numeric|exists:offers,id',
        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }


        $offer =   $request->user()->offers()->find($request->offer_id);


        if ($offer) {

            $offer->update($request->all());

            return responseJson('1','success',$offer);


        } else {

            return responseJson('0','العرض غير متوفر');

        }


    }

    // ==========================  deleteOffer    ============================= //


    public function deleteOffer(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'offer_id' => 'required|numeric|exists:offers,id',
        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }


        $offer =   $request->user()->offers()->find($request->offer_id);


        if ($offer) {

            $offer->delete();

            return responseJson('1','success delete');


        } else {

            return responseJson('0','العرض غير متوفر');

        }

    }

    // ==========================  reviews    ============================= //


    public function reviews(Request $request)
    {
        $request->user()->reviews();

        return responseJson('1','success',[
            'review' => $request->user()->load('reviews')
        ]);

    }



    // ==========================  restaurant state    ============================= //


    public function restaurantState(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'restaurant_id' => 'required|numeric|exists:restaurants,id',
            'state' => 'required|in:open,close',
        ]);

        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }

     $restaurant_state  =  Restaurant::Select('state')->where('id',$request->restaurant_id)->get();

        return responseJson('1','success',$restaurant_state);


    }

    // ========================== change  restaurant state    ============================= //

    public function changeRestaurantState(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'state' => 'required|in:open,close',

        ]);

        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }

        $change_state = $request->user()->update(['state' => $request->state, 'password' => bcrypt($request->password)]);


        return responseJson('1','تم تفير حاله المطعم',$change_state);

    }

    // ==========================  restaurant new order    ============================= //

    public function restaurantNewOrder(Request $request)
    {
        $order = $request->user()->orders()->whereIn('statue',['pending'])->get();
        return responseJson('1','success',[
            'order' => $order->load('client','products')
        ]);

    }

    // ==========================  restaurant accept order    ============================= //


    public function restaurantAcceptOrder(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'order_id' => 'required|exists:orders,id',

        ]);

        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }

       $order =  $request->user()->orders()->find($request->order_id);

        if ($order->statue == 'pending') {

            $order->update(['statue' => 'accepted']);

            $client = $order->client;


            $notifications = $client->notifications()->create([
                'title' => 'تم الموافقه علي الطلب',
                'content' => 'تم الموافقه علي الطلب من قبل المعطم',
                'order_id' => $request->order_id,
            ]);


            $token = $client->tokens()->where('token','!=','')->pluck('token')->toArray();


            if ($token) {

                $title = $notifications->title;
                $content = $notifications->content;
                $order_id = $order->id;


                $send = notifyByFirebase($title,$content,$token,$order_id);

                $data = [
                    'order' => $order->load('products')
                ];

                return responseJson('1','تم الطلب بنجاح',$data);

            }

                return responseJson('1','تم  قبول الطلب');
        }

        return responseJson(0, "لا يوجد طلبات علي قائمة الانتظار");

    }


    // ==========================  restaurant current order    ============================= //


    public function restaurantCurrentOrder(Request $request)
    {
      $order =   $request->user()->orders()->whereIn('statue',['accepted'])->get();

        return responseJson('1','success',[
            'order' => $order->load('client','products')
        ]);


    }

    // ==========================  restaurant previous order    ============================= //


    public function restaurantPreviousOrder(Request $request)
    {
      $order =   $request->user()->orders()->whereIn('statue',['accepted','rejected','delivered'])->get();

        return responseJson('1','success',[
            'order' => $order->load('client','products'),
        ]);
    }


    // ==========================  restaurant rejected order    ============================= //

    public function restaurantRejectedOrder(Request $request)
    {
        $order = $request->user()->orders()->whereIn('statue',['rejected'])->get();

        return responseJson('1','success',[
           'order' => $order->load('client','products'),
        ]);

    }

    // ==========================  restaurant delivered order    ============================= //


    public function restaurantDeliveredOrder(Request $request)
    {
        $order = $request->user()->orders()->whereIn('statue',['delivered'])->get();

        return responseJson('1','success',[
            'order' => $order->load('client','products'),
        ]);

    }



    // ==========================  restaurant deleted order    ============================= //


    public function restaurantDeclinedOrder(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'order_id' => 'required|exists:orders,id',

        ]);

        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }

        $order =  $request->user()->orders()->find($request->order_id);


        if($order->statue == 'pending') {

            $order->update(['statue' => 'rejected']);

            $client = $order->client;

           $notification = $client->notifications()->create([

               'title' => 'تم رفض الطلب',
               'content' => 'تم رفض الطلب من قبل المطعم',
               'order_id' => $request->order_id,

           ]);


       $tokens = $client->tokens()->where('token','!=','')->pluck('token')->toArray();

       if ($tokens) {

           $title = $notification->title;
           $content = $notification->content;
           $order_id =  $request->order_id;

            notifyByFirebase($title,$content,$token,$order_id);

       }


       return responseJson('1','تم ارسال اشعار رفض الطلب',[

           'data' => $request->order_id
       ]);


        }

        return responseJson('0',' لا يمكن رفض طلبك من قبل المطعم');

    }


    // ==========================  commission    ============================= //


    public function commission(Request $request)
    {
        $setting = Setting::first();

        $commission = $setting->commission * 100 . '%';

        $restaurant_sales = $request->user()->orders()->where('statue','delivered')->sum('total');
        $app_commission   = $request->user()->orders()->where('statue','delivered')->sum('commission');

        $rest_app_commission =  $restaurant_sales - $app_commission;

        return responseJson('1','تمت العمليه بنجاح',compact('restaurant_sales','commission','rest_app_commission'));



    }


}
