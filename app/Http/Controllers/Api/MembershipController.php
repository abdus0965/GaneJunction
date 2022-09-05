<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MemberRegistration; 
use App\Models\MemberWebsitesLinks; 
use App\Models\Membership; 
use App\Models\DirectorDetails; 
use Validator;

class MembershipController extends Controller
{
    public $successStatus = 200;

    // Add Member
   
    public function addmember(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|string|between:2,100',
        ]);
        if ($validator->fails()) { 
             return response()->json(['error'=>$validator->errors()], 401);            
 }
 $input = $request->all(); 
        $member = Membership::create($input); 
        $success['name'] =  $member->name;
 return response()->json(['success'=>$success], $this-> successStatus); 
    }

    // Get Member List
    public function GetMemberList(Request $request)
    {
       $list =Membership::select('name')
       ->get();
       return response()->json(["message" => "Member List", 'list' => $list, $this-> successStatus]);
    }

    //Member registration

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'ic_passport_no' => 'required',
            'ic_passport_photo' => 'required',
            'country' => 'required',
            'default_currency' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'state_region' => 'required',
            'phone_no' => 'required',
            'email' => 'required',
            'account_referral_code' => 'required',
            'account_type' => 'required',
            'company_name' => 'required',
            'company_reg_no' => 'required',
            'business_nature' => 'required',
            'company_description' => 'required',
            'ssm_form' => 'required',
            'utility_bill' => 'required',
            'partner_code' => 'required',
            'shop_logo' => 'required',
            'shop_name' => 'required',
            'shop_description' => 'required',
            'selling_item_type' => '',
            'websiteslinks' => 'required',
            'directordetails' => 'required',

           
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors(), "code" => 422]);
        }

        if ($request->account_type=='Individual')
        {
           
             if ($validator->fails()) {
            return response()->json(["message" => $validator->errors(), "code" => 422]);
            }
            
             $member_registration = [
             'member_id' =>  $request->member_id,
             'ic_passport_no' =>  $request->ic_passport_no,
             'ic_passport_photo' =>  $request->ic_passport_photo,
             'country' =>  $request->country,
             'default_currency' =>  $request->default_currency,
             'address1' =>  $request->address1,
             'address2' =>  $request->address2,
             'city' =>  $request->city,
             'zip_code' =>  $request->zip_code,
             'state_region' =>  $request->state_region,
             'phone_no' =>  $request->phone_no,
             'email' =>  $request->email,
             'account_referral_code' =>  $request->account_referral_code,
             'account_type' =>  $request->account_type,
             'company_name' =>  $request->company_name,
             'company_reg_no' =>  $request->company_reg_no,
             'business_nature' =>  $request->business_nature,
             'company_description' =>  $request->company_description,
             'ssm_form' =>  $request->ssm_form,
             'utility_bill' =>  $request->utility_bill,
             'partner_code' =>  $request->partner_code,
             'shop_logo' =>  $request->shop_logo,
             'shop_name' =>  $request->shop_name,
             'shop_description' =>  $request->shop_description,
             'selling_item_type' =>  $request->selling_item_type,
             'status' => "0"
             ];

        try {
            $HOD = MemberRegistration::Create($member_registration);
            } catch (Exception $e) {
                return response()->json(["message" => $e->getMessage(), 'memberregister' => $member_registration, $this-> successStatus]);
            } 
         return response()->json(["message" => "Member Registered Successfully", $this-> successStatus]);
        }

       else if ($request->account_type=='Company')
        {
          
             if ($validator->fails()) {
            return response()->json(["message" => $validator->errors(), "code" => 422]);
            }

             $member_registration = [
                'member_id' =>  $request->member_id,
                'ic_passport_no' =>  $request->ic_passport_no,
                'ic_passport_photo' =>  $request->ic_passport_photo,
                'country' =>  $request->country,
                'default_currency' =>  $request->default_currency,
                'address1' =>  $request->address1,
                'address2' =>  $request->address2,
                'city' =>  $request->city,
                'zip_code' =>  $request->zip_code,
                'state_region' =>  $request->state_region,
                'phone_no' =>  $request->phone_no,
                'email' =>  $request->email,
                'account_referral_code' =>  $request->account_referral_code,
                'account_type' =>  $request->account_type,
                'company_name' =>  $request->company_name,
                'company_reg_no' =>  $request->company_reg_no,
                'business_nature' =>  $request->business_nature,
                'company_description' =>  $request->company_description,
                'ssm_form' =>  $request->ssm_form,
                'utility_bill' =>  $request->utility_bill,
                'partner_code' =>  $request->partner_code,
                'shop_logo' =>  $request->shop_logo,
                'shop_name' =>  $request->shop_name,
                'shop_description' =>  $request->shop_description,
                'selling_item_type' =>  $request->selling_item_type,
                'status' => "0"
             ];

             foreach($request->websiteslinks as $key) {
                $data = array('social_page_link' => $key['social_page_link'],'member_id' =>$request->member_id);
                MemberWebsitesLinks::insert($data);    
            }

            foreach($request->directordetails as $key) {
                $data2 = array('director_name' => $key['director_name'],'member_id' =>$request->member_id,'director_passport_no'=>$key['director_passport_no'],'director_passport_copy'=>$key['director_passport_copy'],);
                DirectorDetails::insert($data2);    
            }

        try {
            $HOD = MemberRegistration::Create($member_registration);
            } catch (Exception $e) {
                return response()->json(["message" => $e->getMessage(), 'member_registration' => $memberregister, $this-> successStatus]);
            } 
         return response()->json(["message" => "Member Registered Successfully", $this-> successStatus]);
        }

    }

        // Update member

        public function update(Request $request, $id)
        {

            if ($request->account_type=='Individual')
            {              
    
            $member = [
                'member_id' =>  $request->member_id,
                'ic_passport_no' =>  $request->ic_passport_no,
                'ic_passport_photo' =>  $request->ic_passport_photo,
                'country' =>  $request->country,
                'default_currency' =>  $request->default_currency,
                'address1' =>  $request->address1,
                'address2' =>  $request->address2,
                'city' =>  $request->city,
                'zip_code' =>  $request->zip_code,
                'state_region' =>  $request->state_region,
                'phone_no' =>  $request->phone_no,
                'email' =>  $request->email, 
                'account_referral_code' =>  $request->account_referral_code, 
                'account_type' =>  $request->account_type, 
                'company_name' =>  $request->company_name,
                'company_reg_no' =>  $request->company_reg_no,
                'business_nature' =>  $request->business_nature,
                'company_description' =>  $request->company_description,
                'ssm_form' =>  $request->ssm_form,
                'utility_bill' =>  $request->utility_bill,
                'partner_code' =>  $request->partner_code,
                'shop_logo' =>  $request->shop_logo,
                'shop_name' =>  $request->shop_name,
                'shop_description' =>  $request->shop_description,
                'selling_item_type' =>  $request->selling_item_type, 
                'websiteslinks' => $request->websiteslinks, 
                'directordetails' => $request->directordetails,

            ];

            foreach($request->websiteslinks as $key) {
                $data3 = array('social_page_link' => $key['social_page_link'],'member_id' =>$request->member_id);
                MemberWebsitesLinks::where('id',"=",$id)->update($data3); 
            }

            foreach($request->directordetails as $key) {
                $data4 = array('director_name' => $key['director_name'],'member_id' =>$request->member_id,'director_passport_no'=>$key['director_passport_no'],'director_passport_copy'=>$key['director_passport_copy'],);
                DirectorDetails::update($data4);    
            }

    
            $memberdata = MemberRegistration::where('id',"=",$id)->update($member);
    
            return response()->json(["message" => "Member Successfully Updated!"], $this-> successStatus);
        }

        else if ($request->account_type=='Company')
        {
          
            $member = [
                'member_id' =>  $request->member_id,
                'ic_passport_no' =>  $request->ic_passport_no,
                'ic_passport_photo' =>  $request->ic_passport_photo,
                'country' =>  $request->country,
                'default_currency' =>  $request->default_currency,
                'address1' =>  $request->address1,
                'address2' =>  $request->address2,
                'city' =>  $request->city,
                'zip_code' =>  $request->zip_code,
                'state_region' =>  $request->state_region,
                'phone_no' =>  $request->phone_no,
                'email' =>  $request->email,
                'account_referral_code' =>  $request->account_referral_code,
                'account_type' =>  $request->account_type,
                'company_name' =>  $request->company_name,
                'company_reg_no' =>  $request->company_reg_no,
                'business_nature' =>  $request->business_nature,
                'company_description' =>  $request->company_description,
                'ssm_form' =>  $request->ssm_form,
                'utility_bill' =>  $request->utility_bill,
                'partner_code' =>  $request->partner_code,
                'shop_logo' =>  $request->shop_logo,
                'shop_name' =>  $request->shop_name,
                'shop_description' =>  $request->shop_description,
                'selling_item_type' =>  $request->selling_item_type,
                'status' => "0"
             ];

             $memberdata = MemberRegistration::where('id',"=",$id)->update($member);
    
             return response()->json(["message" => "Member Successfully Updated!"], $this-> successStatus);
        }
    }

    
        // Edit Member details

        public function editMember(Request $request, $id)
        {
            $list = MemberRegistration::select('*')
                ->where('id', '=', $id)
                ->get();
            return response()->json(["message" => "Member Details", 'list' => $list, "code" => 200]);
        }

}
