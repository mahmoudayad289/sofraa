<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferFormRequest;
use App\Models\Offer;
use Image;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Offer::paginate(10);
        return view('offers.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferFormRequest $request)
    {
        $request->validated();

        if($request->hasFile('photo')) {

            Image::make($request->photo)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('/images/restaurant/offers/'. $request->photo->hashName() ));

        }

        $record =  Offer::create($request->all());

        $record->photo = $request->photo->hashName();

        $record->save();

        flash('تمت العمليه بنجاح')->success();

        return redirect(route('offers.index'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Offer::findOrFail($id);

        return view('offers.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfferFormRequest $request, $id)
    {

        $request->validated();

        if($request->hasFile('photo')) {

            Image::make($request->photo)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('/images/restaurant/offers/'. $request->photo->hashName() ));

        }

        $record = Offer::findOrFail($id);


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
        $record = Offer::findOrFail($id);

        $record->delete();

        flash('تمت العمليه بنجاح')->success();

        return back();
    }
}
