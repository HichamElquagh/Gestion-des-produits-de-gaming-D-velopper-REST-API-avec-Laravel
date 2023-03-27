<?php

namespace App\Http\Controllers\role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeRoleRequest;
use  App\Models\User;

class RolePermissionController extends Controller
{

    public function changeRole(ChangeRoleRequest $request,User $user){
        $user->syncRoles([$request->validated()]);
        // return $user;
        return response()->json([
            'status' => true,
            'message' => "User updated successfully!",
            'data' => $user
        ], 200);
      }
      
      public function removeRole(User $user){
        $user->syncRoles("user");
        // return $user;
        return response()->json([
            'status' => true,
            'message' => "Role removed successfully!",
            'data' => $user
        ], 200);
      }
      public function changePermissionToRole(User $user){
        
      }
          
}
