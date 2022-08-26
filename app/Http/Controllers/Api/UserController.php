<?php
 
namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Validator;
 
class UserController extends Controller
{
    
    public $successStatus = 200;
 /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){

            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyLaravelApp')-> accessToken; 
            $success['userId'] = $user->id;
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
 
 /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'date_of_birth' => 'required', 
            'gender' => 'required',
            'mobile_no' => 'required|min:10',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'referral_code' => 'required',
        ]);
        if ($validator->fails()) { 
             return response()->json(['error'=>$validator->errors()], 401);            
 }
 $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyLaravelApp')-> accessToken; 
        $success['username'] =  $user->username;
 return response()->json(['success'=>$success], $this-> successStatus); 
    }
 
 /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function userDetails() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    }

        
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'date_of_birth' => 'required',
        'gender' => 'required',
        'mobile_no' => 'required',
        'referral_code' => 'required',
    ]);
    if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
}
User::where(
    ['id' => $request->id]
    )->update([
    'first_name' =>  $request->first_name,
    'last_name' =>  $request->last_name,
    'email' =>  $request->email,
    'date_of_birth' =>  $request->date_of_birth,
    'gender' =>  $request->gender,
    'mobile_no' =>  $request->mobile_no,
    'referral_code' =>  $request->referral_code
    ]);

    return response()->json(["message" => "User has updated successfully", $this-> successStatus]);

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
  
      return response()->json(['message' => 'Password Update Successfully'], $this-> successStatus);
}


       /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out'], $this-> successStatus);
    }
}