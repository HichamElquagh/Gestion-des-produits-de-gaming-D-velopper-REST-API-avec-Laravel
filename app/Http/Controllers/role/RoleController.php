<?php

namespace App\Http\Controllers\role;

use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRole(StoreRoleRequest $request)
    {
        //
       
        $storerole = Role::create(['name' => $request->name]);
        $storerole->syncPermissions($request->permission);
         if($storerole){
            return response()->json([
                'status'=>true,
                'role'=>'creted seccessfully',
                'role'=>new RoleResource($storerole)
              ]);
         }
         else {
            return response()->json([
            'status'=>false,
            'role'=>'erreur en role'
            ]);
         }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function showRole(Role $role , $id)
    {
        //

        $showrole =$role->find($id);

        if(!$showrole){
            return response()->json([
             'status'=>false,
             'role'=>'not role found'
            ]);
        }

        else{
            return response()->json([
            'status'=>true,
            'role'=>new RoleResource($showrole)
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function updateRole(UpdateRoleRequest $request,$id)
    {
        $role = Role::find($id);
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permission);

        if(!$role){
            return response()->json([
             'status'=>false,
             'role'=>'erreur role'
            ]);
        }

        else{
            return response()->json([
            'status'=>true,
            'role'=>'role updated successfully',
            'role'=>new RoleResource($role)
                ]);
        }

 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function deleteRole($id)
    {
        //
      $role = Role::find($id);
        $role->delete();

        if(!$role){
            return response()->json([
              'status'=>false,
              'role'=>'erreur en delete'
            ]);
        }
        else{
            return response()->json([
                'status'=>true,
                'role'=>'role is deleted successfully'
            ]);
        }
    }
}
