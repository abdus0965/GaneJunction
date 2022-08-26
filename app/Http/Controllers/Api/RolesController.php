<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Roles;
use App\Models\RoleUser; 
use App\Models\Vendors; 
use App\Models\RoleVendor; 
use App\Models\Consultants; 
use Validator;

class RolesController extends Controller
{
    //
    public function index()
    {
        return Roles::select('id', 'name', 'status')->get();
    }

    public function check_point($name, $role_id)
    {
        if ($role_id == 0)
            return Roles::where(['name' => $name])->get()->count();
        else
            return Roles::where(['name' => $name])->where('id', '!=', $role_id)->get()->count();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required|integer',
            'user_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $roles = $this->check_point($request->name, 0);
        if ($roles > 0) {
            return response()->json(["message" => "Role Already Exists.", "code" => 200]);
        }

        $role = new Roles;
        $role->name = $request->name;
        $role->status = $request->status;
        $role->save();

        $role1 = new RoleUser;
        $role1->user_id =  $request->user_id;
        $role1->role_id =  $role->id;
        $role1->status = $request->status;
        $role1->save();
        return response()->json(["message" => "A new role has been added into the system", "code" => 200]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'role_id' => 'required|integer',
            'name' => 'required',
            'status' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $roles = $this->check_point($request->name, $request->role_id);
        if ($roles > 0) {
            return response()->json(["message" => "Role Already Exists.", "code" => 200]);
        }
        $role = Roles::find($request->role_id);
        $role->user_id =  $request->user_id;
        $role->name = $request->name;
        $role->status = $request->status;
        $role->save();
        return response()->json(["message" => "A role has been updated", "code" => 200]);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'role_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $role = Roles::find($request->role_id);
        $role->user_id = $request->user_id;
        $role->status = 0;
        $role->save();
        return response()->json(["message" => "A role has been deleted", "code" => 200]);
    }

    public function set_role(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'role_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        DB::table('role_user')->updateOrInsert(['user_id' => $request->input('user_id')], ['role_id' => $request->input('role_id')]);
        return response()->json("Role has been assigned to user", 200);
    }

    //vendor data store

    public function storevendor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'status' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $vendor = new Vendors;
        $vendor->name = $request->name;
        $vendor->type = $request->type;
        $vendor->status = $request->status;
        $vendor->save();

        return response()->json(["message" => "A new vendor has been added into the system", "code" => 200]);
    }


    //store vendor role

    public function storevendorrole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'vendor_id' => 'required|integer',
            'status' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $vendor = new Vendors;
        $vendor->name = $request->name;
        $vendor->type = $request->type;
        $vendor->status = $request->status;
        $vendor->save();

        $vendor1 = new RoleVendor;
        $vendor1->role_id =  $role->id;
        $vendor1->vendor_id =  $request->vendor_id;
        $vendor1->status = $request->status;
        $vendor1->save();

        return response()->json(["message" => "A new vendor has been added into the system", "code" => 200]);
    }

     //store Consultants

     public function storeconsultants(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'user_id' => 'required',
             'vendor_id' => 'required',
             'name' => 'required',
             'status' => 'required|integer'
         ]);
         if ($validator->fails()) {
             return response()->json($validator->errors(), 422);
         }
 
         $consultants = new Consultants;
         $consultants->user_id =  $role->user_id;
         $consultants->vendor_id =  $vendor->vendor_id;
         $consultants->name =  $request->name;
         $consultants->status = $request->status;
         $consultants->save();
 
         return response()->json(["message" => "A new Consultants has been added into the system", "code" => 200]);
     }

}
