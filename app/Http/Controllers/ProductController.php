<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Product::paginate(10);
        return view('products.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {
        $request->validated();

        if($request->hasFile('photo')) {

            Image::make($request->photo)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('/images/restaurant/product/'. $request->photo->hashName() ));

        }

        $record =   Product::create($request->all());

        $record->photo = $request->photo->hashName();

        $record->save();

        flash('تمت العمليه بنجاح')->success();

        return view('products.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Product::findOrFail($id);

        return view('products.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, $id)
    {

        $request->validated();

        if($request->hasFile('photo')) {

            Image::make($request->photo)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('/images/restaurant/product/'. $request->photo->hashName() ));

        }

        $record = Product::findOrFail($id);

        $record->update($request->all());

        $record->photo = $request->photo->hashName();

        $record->save();

        flash('تمت العمليه بنجاح')->success();

        return back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Product::findOrFail($id);

        $record->delete();

        flash('تمت العمليه بنجاح')->success();

        return back();
    }
}
