<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantFormRequest;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Image;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Restaurant::paginate(10);


        return view('restaurants.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestaurantFormRequest $request)
    {
        $request->validated();

        if($request->hasFile('image')) {

            Image::make($request->image)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('/images/restaurant/'. $request->image->hashName() ));
        }

        $record = Restaurant::create($request->all());

        $record->image = $request->image->hashName();

        $record->save();

        flash('تمت العمليه بنجاح')->success();

        return redirect(route('restaurants'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Restaurant::findOrFail($id);

        return view('restaurants.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RestaurantFormRequest $request, $id)
    {
        $request->validated();

        if($request->hasFile('image')) {

            Image::make($request->image)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('/images/restaurant/'. $request->image->hashName() ));
        }


        dd($request->all());

        $record = Restaurant::findOrFail($id);

        $record->update($request->all());


        $record->image = $request->image->hashName();

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
        $record = Restaurant::findOrFail($id);

        $record->delete();

        flash('تمت العمليه بنجاح')->success();

        return back();
    }
}
