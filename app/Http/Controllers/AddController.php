<?php
namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;


class AddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
   //
        // echo 'hiii';
          $contacts = Contact::all();

        return view('contacts.index', compact('contacts'));
    }

  
}