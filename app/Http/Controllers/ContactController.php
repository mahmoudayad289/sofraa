<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Contact::paginate(20);

        return view('contacts.index', compact('records'));
    }


    public function destroy($id)
    {
        $record = Contact::findOrFail($id);

        $record->delete();
        return  back();
    }
}
