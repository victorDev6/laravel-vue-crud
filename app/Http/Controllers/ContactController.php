<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    
    public function index()
    {
        return Contact::get();
    }

    
    public function store(Request $request)
    {
        $contact = new Contact();
        $contact->crete($request->all());
    }

    
    public function show(Contact $contact)
    {
        return $contact;
    }

    
    public function update(Request $request, Contact $contact)
    {
        //
    }

    
    public function destroy(Contact $contact)
    {
        //
    }
}
