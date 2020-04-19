<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\City;
use App\Models\Client;
use App\Models\District;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{

    // ==========================   cities    ============================= //


    public function cities()
    {

        $cities = City::get();

        return responseJson('1','تم العرض بنجاح',$cities);

    }


    // ==========================   districts    ============================= //


    public function districts(Request $request)
    {

        $districts = District::where(function ($query) use ($request) {

            if($request->has('city_id')) {

               $query->where('city_id', $request->city_id);
            }

        })->get();



        return responseJson('1','تم العرض بنجاح',$districts);

    }


    // ==========================   settings    ============================= //


    public function settings()
    {
        $settings = Setting::all();

        return responseJson('1','تم العرض بنجاح',$settings);
    }


    // ==========================   contacts    ============================= //


    public function contacts(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }


        $contact = $request->user()->contacts()->create($request->all());


        return responseJson('1','success',$contact);

    }


    // ==========================   add reviews    ============================= //


    public function addReviews(Request $request)
    {

        $validator = Validator::make($request->all(),[

            'comment'   => 'required',
            'rate'      => 'required|numeric',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);

        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }



        $review = $request->user()->reviews()->create($request->all());




        return responseJson('1','success',$review);

    }


    // ==========================   restaurants data    ============================= //


    public function restaurantsData(Request $request)
    {

        $restaurants = Restaurant::where(function ($query) use($request) {

            if ($request->has('restaurant_id')) {

                $query->where('id', $request->restaurant_id);
            }
        })->get();

        return responseJson('1','success',$restaurants);
    }

    // ==========================   new order    ============================= //



    public function newOrder(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'restaurant_id'     => 'required',
            'products'          => 'required|array',
            'products.*'           => 'exists:products,id',
            'notes'             => 'required',
            'amount'            => 'required|array',
            'address'           => 'required',
            'payment_method'    => 'required|in:online,cash',
        ]);


        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }


        $restaurant = Restaurant::find($request->restaurant_id);

        if ($restaurant->state == 'close') {

            return responseJson('0','المطعم مغلق حالا');

        }



        $order = $request->user()->orders()->create([
            'restaurant_id'      => $request->restaurant_id,
            'notes'              => $request->notes,
            'amount[]'           => $request->amount,
            'statue'             => 'pending',
            'payment_method'     => $request->payment_method,
            'address'            => $request->address,
        ]);



            $cost = 0;
        if ($request->has('products')) {

            $counter = 0;

            foreach ($request->products as $productId) {

                $item = Product::find($productId);

                $order->products()->attach([

                    $productId = [
                        'note'      => $request->notes[$counter],
                        'quantity'  => $request->amount[$counter],
                        'price'     => $item->price,
                        'product_id' => $item->id
                    ]
                ]);

                $cost += ($item->price * $request->amount[$counter]);
                $counter++;

            }

        }

        $delivery_cost = $restaurant->delivery_charge;

        if ($cost >= $restaurant->minimum_order) {
            $total = $cost + $delivery_cost;
            $commission = Setting::find(1)->commission * $cost;
            $rest = $total - $commission;

            $order->update([
                'cost' => $cost,
                'delivery_cost' => $delivery_cost,
                'total' => $total,
                'commission' => $commission,
                'rest' => $rest,
            ]);


            $notification = $restaurant->notifications()->create([
                'title' => 'لديك طلب جديد',
                'content' => 'لديك طلب جديد من العميل' . $request->user()->name,
                'order_id' => $order->id,
            ]);

            $tokens = $restaurant->tokens('where','!=','')->pluck('token')->toArray();

            if ($tokens) {
                $title = $notification->title;
                $content = $notification->content;
                $data = $order->id;
                $send = notifyByFirebase($title, $content, $tokens, $data);
            }

            return responseJson('1','تم الطلب بنجاح',[
               'order' => $order->fresh()->load('client','restaurant.categories','restaurant.district'),
            ]);


        } else {

            $order->products()->delete();
            $order->delete();

            return responseJson('0','الطلب اقل من ', $restaurant->minimum_order . 'جنيه');
        }



    }


    // make validation
    // find the restaurant id
    // check the restaurant open or close
    // create order
    // make shore exists products make loop
    // count the cost
    // count the commission
    // send notification for this restaurant

    // ==========================   details order    ============================= //


    public function detailsOrder(Request $request)
    {
        $details = $request->user()->orders()->where(function ($query) use ($request) {

            if($request->has('order_id')) {

                $query->where('id', $request->order_id);
            }

        })->get();


        if ($details) {

            return responseJson('1','success',$details);

        } else {

            return responseJson('0','خطا في الطلب');
        }

    }


    // ==========================   accepted order    ============================= //

    public function acceptedOrder(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'order_id' => 'required|exists:orders,id',
        ]);

        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }


        $order = $request->user()->orders()->find($request->order_id);


        if ($order) {

            $order->update(['statue' => 'accepted']);

            return responseJson('1','تم الموافقه علي الطلب');

        } else {


            return responseJson('0','تم رفض الطلب');

        }


    }

    // ==========================   delivered order    ============================= //


    public function deliveredOrder(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'order_id' => 'required|exists:orders,id',
        ]);

        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }


        $order = $request->user()->orders()->find($request->order_id);


        if ($order) {

            $order->update(['statue' => 'delivered']);

            return responseJson('1','تم  استلام الطلب');

        } else {


            return responseJson('0','  حدث خطا في استلام الطلب');

        }

    }


    // ==========================   current order    ============================= //


    public function currentOrder(Request $request)
    {
        $order = $request->user()->orders()->where('statue' ,'accepted')->get();
        return responseJson('1','success',$order);

    }


    // ==========================   previous order    ============================= //


    public function previousOrder(Request $request)
    {

        $order = $request->user()->orders()->whereIn('statue', ['accepted','rejected','delivered'])->latest()->paginate(20);
        return responseJson('1','success',$order);

    }


    // ==========================   rejected order    ============================= //


    public function rejectedOrder(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'order_id' => 'required|exists:orders,id',
        ]);

        if ($validator->fails()) {

            return responseJson('0',$validator->errors()->first(),$validator->fails());
        }


        $order = $request->user()->orders()->find($request->order_id);


        if ($order) {

            $order->update(['statue' => 'rejected']);

            $restaurant = $order->restaurant;


            $notification = $restaurant->notifications()->create([
                'title' => 'لديل اشعار جديد من العميل',
                'content' => 'تم رفض الطلب من قبل العميل',
                'order_id' => $order->id,
            ]);

            $token = $restaurant->tokens()->where('token','!=','')->pluck('token')->toArray();

            if ($token) {

                $title = $notification->title;
                $content = $notification->content;
                $order_id = $order->id;


                $send = notifyByFirebase($title,$content,$token,$order_id);


                return responseJson('1','تم رفض استلام الطلب');


            } else {

                return responseJson('0','  حدث خطا ما');

            }


        } else {

            return responseJson('0','  حدث خطا في استلام الطلب');

        }


    }


    // make validate for the order id
    // find order id from user login
    // change statue to rejected
    // find restaurant
    // make notification
    // get token for this restaurant
    // sent notification with firebase title ,content , order, token

}
