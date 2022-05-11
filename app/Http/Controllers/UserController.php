<?php
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\User;
  
class UserController extends Controller
{
   
    public function index()
    {
        $users = User::get();
        return view('users',compact('users'));
    }
  

    public function changeUserStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
  
        return response()->json(['success'=>'User status change successfully.']);
    }
}
?>