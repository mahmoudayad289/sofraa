<?php

namespace App\Http\Controllers\Front\Client;

use App\Models\City;
use App\Models\Contact;
use App\Models\District;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $rearch_request = $request->get('rest_search');

        $restaurant = Restaurant::query()->where(function ($q)use($request){
            $q->where('district_id',$request->district_id);
        })->where('name', 'LIKE', '%' . $rearch_request  . '%')

        ->latest()->paginate(10);
        $districts = District::get();


//        dd($restaurants->toArray());

        return view('front.index', compact('restaurant','districts'));

    }


    // ==========================   Contact    ============================= //



    public function contact()
    {
        return view('front.contact');

    }


    // ==========================   Contact us   ============================= //


    public function contactUs(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required|min:10',
            'type' => 'required',
        ]);


        Contact::create($request->all());

        flash('تم الارسال بنجاح')->success();


        return redirect(back());

    }






    // ==========================   cart   ============================= //


    public function cart()
    {
        return view('front.cart');
    }






    // ==========================   cart   ============================= //


    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);

//        dd($product->toArray());

        if (!$product) {

            abort(404);
        }

        $cart = session()->get('cart');

        if ($cart) {

            $cart = [
                    'name' => $product->name,
                    'quantity' => 0,
                    'photo' => $product->photo,
                    'price' => $product->price,
            ];

          session()->put('cart',$cart);

        } elseif(isset($cart)) {

            $cart['quantity']++;

            session()->put('cart',$cart);
        }

        $cart = [
            'name' => $product->name,
            'quantity' => 0,
            'photo' => $product->photo,
            'price' => $product->price,
        ];


       $request->session()->put(['cart'=> $cart]);

        return redirect()->back()->with('success','تم اضافه المنتح بنجاح');


    }




}
