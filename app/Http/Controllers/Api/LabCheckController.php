<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\LabCheckProduct; 
use App\Models\LabCheckCategory;
use App\Models\LabCheckShippingDetails;
use App\Models\LabCheckSEO;
use App\Models\LabCheckGallery; 
use App\Models\LabCheckAccessories;
use Illuminate\Http\Request;
use Validator;

class LabCheckController extends Controller
{
    
    public $successStatus = 200;

    //store Labcheck category

    public function AddLabcheckCategory(Request $request)
        {
    
        $validator = Validator::make($request->all(), [ 
        'name'=>'required',
        ]);
    
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
    }
    
        $category = new LabCheckCategory();
    
        $category ->name = $request->input('name');
        $category ->save();
    
        return response()->json(["message" => "LabCheck Category successfully added!"], $this-> successStatus); 
          
}

    // Get LabCheck Category List

    public function getLabcheckCategory(Request $request)
    {
       $list =LabCheckCategory::select('id', 'name')->where('name','=', $request->name)
       ->get();
       return response()->json(["message" => "LabCheck Category List", 'list' => $list, "code" => 200]);
    }

     // store LabCheck product

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
         'category_id'=>'required',
         'name'=>'required',
         'short_description'=>'required',
         'main_description'=>'required',
         'sku'=>'required',
         'inventory_id'=>'required',
         'discount_id'=>'required',
         'price'=>'required',
         'min_qty'=>'required',
         'max_qty'=>'required',
         'stock_quantity'=>'required',
         'labcheck_option'=>'0',
         'online_status'=>'0',
         'status'=>'0',
         'main_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);
 
    $input = $request->all();
 
     if ($image = $request->file('main_image')) {
         $destinationPath = 'image/';
         $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
         $image->move($destinationPath, $profileImage);
         $input['main_image'] = "$profileImage";
    }
 
     LabCheckProduct::create($input);
  
     return response()->json(["message" => "LabCheck Successfully Added!"], $this-> successStatus);
}

    // Store Labcheck Shipping Attributes

    public function AddShipping(Request $request)
        {
                   
            $validator = Validator::make($request->all(), [ 
                'require_shipping' => 'required',
                'ship_world_wide' => 'required',
                'width' => 'required',
                'length' => 'required',
                'height' => 'required',
                'unit' => 'required',
                'weight' => 'required',
                ]);
                   
                    if ($validator->fails()) { 
                        return response()->json(['error'=>$validator->errors()], 401);            
                }
                   
                $shipping = new LabCheckShippingDetails();
                    
                $shipping ->require_shipping = $request->input('require_shipping');   
                $shipping ->ship_world_wide = $request->input('ship_world_wide');
                $shipping ->width = $request->input('width');
                $shipping ->length = $request->input('length');
                $shipping ->height = $request->input('height');
                $shipping ->unit  =  $request->input('unit');
                $shipping ->weight = $request->input('weight');
                $shipping ->save();
                   
                return response()->json(["message" => "Labcheck Shipping successfully added!"], $this-> successStatus); 
                         
        }


      // Store Labcheck SEO

      public function AddSEO(Request $request)
      {
                 
          $validator = Validator::make($request->all(), [ 
              'tags' => '',
              'meta_description' => '',
              ]);

              foreach($request->tags as $key) {
                $data = array('labcheck_tags' => $key['labcheck_tags'],'meta_keywords'=>$key['meta_keywords']);
                LabCheckSEO::insert($data);    
            }
                 
                  if ($validator->fails()) { 
                      return response()->json(['error'=>$validator->errors()], 401);            
              }
                 
              $addseo = new LabCheckSEO();
                     
              $addseo ->meta_description = $request->input('meta_description');
              $addseo ->save();
                 
              return response()->json(["message" => "LabCheck SEO successfully added!"], $this-> successStatus); 
                       
    }

  // Store LabCheck accessories

  public function AddAccessories(Request $request)
  {
             
      $validator = Validator::make($request->all(), [ 
          'accessories' => 'required',
          ]);
             
              if ($validator->fails()) { 
                  return response()->json(['error'=>$validator->errors()], 401);            
          }
             
              $accessories = new LabCheckAccessories();
             
              foreach($request->accessories as $key) {
                  $data3 = array('labcheck_size' => $key['labcheck_size'],'labcheck_color' => $key['labcheck_color'],'price' => $key['price'],'price_type' => $key['price_type'],'weight' => $key['weight'],'labcheck_size_image' => $key['labcheck_size_image'],'labcheck_color_image' => $key['labcheck_color_image']);
                  LabCheckAccessories::insert($data3);    
              }
              $accessories ->save();
             
              return response()->json(["message" => "Labcheck Accessories successfully added!"], $this-> successStatus); 
                   
    }

    // Store Labcheck Gallery

    public function AddLabcheckGallery(Request $request)
    {
                              
        $validator = Validator::make($request->all(), [ 
        'labcheck_images' => 'required|image|mimes:jpeg,png,jpg|max:2048',
         ]);
                              
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
                              
        $pgallery = new LabCheckGallery();

        $arr=[];
        foreach ($request->files as $key => $value) {
        $arr[]=$value;
        }
                                                           
        $pgallery ->save();
                              
        return response()->json(["message" => "Labcheck Images successfully added!"], $this-> successStatus); 
                                    
    }               

}
