<?php

namespace App\Http\Controllers\Front\Restaurant;

use App\Http\Requests\OfferFormRequest;
use App\Http\Requests\ProductFormRequest;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class MainController extends Controller
{
    public function showRestaurant($id)
    {
        $record = Restaurant::findOrFail($id);

        return view('front.show-restaurant', compact('record'));

    }


    public function restaurants()
    {
        $restaurants = Restaurant::where(function (){

        })


        ->orderBy('created_at','desc')->paginate(20);

        return view('front.restaurants', compact('restaurants'));

    }


    public function allProduct()
    {
        $record = Product::orderBy('created_at','desc')->paginate(20);

        return view('front.product.index', compact('record'));

    }


    public function productForm()
    {
        return view('front.product.form-product');
    }


    public function createProduct(ProductFormRequest $request)
    {

        $request->validated();

        if($request->hasFile('photo')) {

            Image::make($request->photo)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('/images/restaurant/product/'. $request->photo->hashName() ));
        }

        $product =   Product::create($request->all());

        $product->photo = $request->photo->hashName();

        $product->save();

        flash('تمت الاضافه بنجاح')->success();

        return view('front.product.form-product');

    }


    public function EditProduct($id)
    {
        $product = Product::findOrFail($id);

        return view('front.product.edit-product' ,compact('product'));


    }


    public function ShowProduct($id)
    {
        $product = Product::findOrFail($id);

        return view('front.product.show-product', compact('product'));
    }


    public function updateProduct(ProductFormRequest $request, $id)
    {
        $request->validated();

        $product = Product::findOrFail($id);


        $product->update($request->all());


        flash('تمت التعديل بنجاح')->success();

        return redirect(route('all.products'));

    }


    public function allOffers()
    {

        $offers = Offer::all();

        return view('front.offer.index', compact('offers'));

    }


    public function offerForm()
    {
        return view('front.offer.form-offer');

    }


    public function createOffer(OfferFormRequest $request)
    {
        $request->validated();

        if($request->hasFile('photo')) {

            Image::make($request->photo)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('/images/restaurant/offers/'. $request->photo->hashName() ));
        }

        $offer =   Offer::create($request->all());

        $offer->photo = $request->photo->hashName();

        $offer->save();

        flash('تمت الاضافه بنجاح')->success();

        return view('front.offer.form-offer');
    }


    public function EditOffer($id)
    {
        $offer = Offer::findOrFail($id);

        return view('front.offer.edit-offer' ,compact('offer'));


    }


    public function updateOffer(OfferFormRequest $request , $id)
    {
        $request->validated();

        $offer = Offer::findOrFail($id);

        $offer->update($request->all());


        flash('تمت التعديل بنجاح')->success();

        return redirect(route('all.offers'));
    }

}
