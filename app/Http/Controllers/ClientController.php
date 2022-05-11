<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Group;
use App\Models\Whatsapp;
use Carbon\Carbon;
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
        return view('client.index', ['data' => Client::all()]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        return view('client.create', ['groups' => Group::where('status', 1)->get(), 'client' => $client]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required',
            'full_name' => 'required',
            'company_name' => 'required',
            'title' => 'required',
            'first_name' => 'required',
            'surname' => 'required',
            'friendly_name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile_phone' => 'required|digits:10',
            'work_phone' => 'required',
            'fax' => 'required',
            'notes' => 'required',
        ]);

        $client = Client::create($request->all());
        return redirect(route('client.index'))->with('success', 'successful', $client->full_name . 'saved successfully!');
    }
    
    public function edit(Client $client)
    {
        return view('client.edit', ['groups' => Group::where('status', 1)->get(), 'client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'full_name' => 'required',
            'company_name' => 'required',
            'title' => 'required',
            'first_name' => 'required',
            'surname' => 'required',
            'friendly_name' => 'required',
            'email' => 'required',
            'mobile_phone' => 'required',
            'work_phone' => 'required',
            'fax' => 'required',
            'notes' => 'required',
        ]);
        $client->update($request->all());
        return redirect(route('client.index'))->with('success', 'Client updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return back()->with('success', 'Contact deleted!');
    }
    
    public function GetClientCount(Request $request)
    {
        $client = Client::where('group_id', $request->group_id);
        return response(['total' => $client->count(), 'client' => $client->get()], 200);
    }
}
