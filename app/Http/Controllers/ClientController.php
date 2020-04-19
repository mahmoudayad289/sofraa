<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientFormRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Client::paginate(15);


        return view('clients.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientFormRequest $request)
    {

        $request->validated();


        if($request->hasFile('image')) {

            Image::make($request->image)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('/images/client/'. $request->image->hashName() ));

        }

        $request->merge(['password' => bcrypt($request->password)]);

        Client::create($request->all());

        flash('تمت العمليه بنجاح')->success();


        return redirect(route('clients.index'));

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
        $model = Client::findOrFail($id);


        return view('clients.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientFormRequest $request, $id)
    {
        $request->validated();


        if($request->hasFile('image')) {

            Image::make($request->image)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('/images/client/'. $request->image->hashName() ));

        }

        $record = Client::findOrFail($id);


        $record->password = bcrypt($request->password);

        $record->update($request->all());


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
        $record = Client::findOrFail($id);

        $record->delete();

        flash('تمت العمليه بنجاح')->success();

        return back();
    }
}
