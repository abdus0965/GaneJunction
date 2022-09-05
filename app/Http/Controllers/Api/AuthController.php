<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (auth()->attempt($request->all())) {
            return response([
                'user' => auth()->user(),
                'access_token' => auth()->user()->createToken('authToken')->accessToken
            ], Response::HTTP_OK);
        }

        return response([
            'message' => 'This User does not exist'
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function register(Request $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'mobile_no' => $request->mobile_no,
            'password' => Hash::make($request->password),
            'referral_code' => $request->referral_code
        ]);

        return response($user, Response::HTTP_CREATED);
    }


    public function updatePost(Request $request, $id)
    {
        $user = [
            'first_name' =>  $request->first_name,
            'last_name' =>  $request->last_name,
            'email' =>  $request->email,
            'date_of_birth' =>  $request->date_of_birth,
            'gender' =>  $request->gender,
            'mobile_no' =>  $request->mobile_no,
            'referral_code' =>  $request->referral_code,
        ];

        $userdetails = User::where('id',"=",$id)->update($user);

        return response([
            'message' => 'User Updated Successfully'
        ], Response::HTTP_UNAUTHORIZED);
    }



        // Edit User details

        public function editUser(Request $request, $id)
        {
            $list = User::select('first_name', 'last_name', 'email', 'date_of_birth','gender','mobile_no')
                ->where('id', '=', $id)
                ->get();
            return response()->json(["message" => "User Details", 'list' => $list, "code" => 200]);
        }
        

        // change password 
   
    public function changePasswordPost(Request $request)
        {
      
            $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required|string',
      
        ]);
    
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);
        }
      
        $changePassword = DB::table('password_resets')
                            ->where(['email' => $request->email])
                            ->first();
      
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
                      return response([
                        'message' => 'Password Update Successfully'
                    ], Response::HTTP_UNAUTHORIZED);
    }


    public function logout()
    {
        auth()->logout();
        return response([
            'message' => 'Log out success'
        ], Response::HTTP_UNAUTHORIZED);
    }
}