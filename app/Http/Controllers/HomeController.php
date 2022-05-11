<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'group' => Group::all(),
            'client' => Client::count(),
            'filecount' =>DB::table('temp_csv_data')->count()
        ]);
    }
}
