<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use  App\Models\User;

class EditProfileController extends Controller
{
    //
    public function showprofile(){

        $id = Auth::user()->id;
        $user =  User::find($id);
        if(!$user){ 
        return response()->json([
           'status'=>'profile not found',
        ]);
    }
    else {
        return response()->json([
            'status'=>true,
            'name'=>$user->name,
            'email'=>$user->email,
         ]);
    }
    }

    public function update(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id); 

      $request->validate([
        'name' => 'required',
        'email' => 'required|',
        'old_password' => 'required',
        'password'=>'required|confirmed',
      ]);
       //  #Match The Old Password
       if(!Hash::check($request->old_password, $user->password)){
        return  response()->json([
          'messsage'=> 'old password Doesn"t match!',
        ]);
    }

      $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'updated_at' => now(),
    ]);

    return response()->json([
      'status'=>'true',
      'updated'=>$user,

    ]);
}

    

}
