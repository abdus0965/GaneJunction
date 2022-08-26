<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\ProductCategory; 
use App\Models\Brand; 
use App\Models\ProductInventory;
use App\Models\Discount;   
use App\Models\ProductAccessories; 
use App\Models\ProductShippingDetails;
use App\Models\ProductSEO;
use App\Models\ProductGallery;
use Validator;

class ProductController extends Controller
{
    public $successStatus = 200;

        //store category

        public function AddCategory(Request $request)
        {
    
            $validator = Validator::make($request->all(), [ 
               'name'=>'required',
               'description'=>'required',
            ]);
    
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);            
    }
    
            $category = new ProductCategory();
    
            $category ->name = $request->input('name');
            $category ->description = $request->input('description');
            
            $category ->save();
    
            return response()->json(["message" => "Category successfully added!"], $this-> successStatus); 
          
        }
    
    // store products

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
        'enable_product_option'=>'0',
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

    Product::create($input);
 
    return response()->json(["message" => "Product Successfully Added!"], $this-> successStatus);
}


    // Store Brands

    public function AddBrand(Request $request)
        {
       
               $validator = Validator::make($request->all(), [ 
                  'brand_name'=>'required',
               ]);
       
               if ($validator->fails()) { 
                   return response()->json(['error'=>$validator->errors()], 401);            
    }
       
               $brand = new Brand();
       
               $brand ->brand_name = $request->input('brand_name');   
               $brand ->save();
       
               return response()->json(["message" => "Brand successfully added!"], $this-> successStatus); 
             
        }

            // Store Product Inventory

    public function AddInventory(Request $request)
    {
   
           $validator = Validator::make($request->all(), [ 
              'quantity'=>'required',
           ]);
   
           if ($validator->fails()) { 
               return response()->json(['error'=>$validator->errors()], 401);            
}
   
           $inventory = new ProductInventory();

           $inventory ->quantity = $request->input('quantity');   
           $inventory ->save();
   
           return response()->json(["message" => "Product Quantity successfully added!"], $this-> successStatus); 
         
    }

            // Store Product Discount

        public function AddDiscount(Request $request)
            {
               
                       $validator = Validator::make($request->all(), [ 
                          'name'=>'required',
                          'discount_percent'=>'required',
                          'status'=>'0',
                       ]);
               
                       if ($validator->fails()) { 
                           return response()->json(['error'=>$validator->errors()], 401);            
            }
               
                       $discount = new Discount();
               
                       $discount ->name = $request->input('name');   
                       $discount ->discount_percent = $request->input('discount_percent');
                       $discount ->save();
               
                       return response()->json(["message" => "Discount successfully added!"], $this-> successStatus); 
                     
        }


        // Store Product accessories

        public function AddAccessories(Request $request)
            {
                       
                $validator = Validator::make($request->all(), [ 
                    'accessories' => 'required',
                    ]);
                       
                        if ($validator->fails()) { 
                            return response()->json(['error'=>$validator->errors()], 401);            
                    }
                       
                        $accessories = new ProductAccessories();
                       
                        foreach($request->accessories as $key) {
                            $data = array('product_size' => $key['product_size'],'product_color' => $key['product_color'],'price' => $key['price'],'price_type' => $key['price_type'],'weight' => $key['weight'],'product_size_image' => $key['product_size_image'],'product_color_image' => $key['product_color_image']);
                            ProductAccessories::insert($data);    
                        }
                        $accessories ->save();
                       
                        return response()->json(["message" => "Products Accessories successfully added!"], $this-> successStatus); 
                             
                }

                // Store Product Shipping Attributes

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
                           
                        $shipping = new ProductShippingDetails();
                            
                        $shipping ->require_shipping = $request->input('require_shipping');   
                        $shipping ->ship_world_wide = $request->input('ship_world_wide');
                        $shipping ->width = $request->input('width');
                        $shipping ->length = $request->input('length');
                        $shipping ->height = $request->input('height');
                        $shipping ->unit  =  $request->input('unit');
                        $shipping ->weight = $request->input('weight');
                        $shipping ->save();
                           
                        return response()->json(["message" => "Products Shipping successfully added!"], $this-> successStatus); 
                                 
                }

                    // Store Product SEO

                    public function AddSEO(Request $request)
                        {
                                   
                            $validator = Validator::make($request->all(), [ 
                                'product_tags' => 'required',
                                'meta_keywords' => 'required',
                                'meta_description' => 'required',
                                ]);
                                   
                                    if ($validator->fails()) { 
                                        return response()->json(['error'=>$validator->errors()], 401);            
                                }
                                   
                                $addseo = new ProductSEO();
                                    
                                $addseo ->product_tags = $request->input('product_tags');   
                                $addseo ->meta_keywords = $request->input('meta_keywords');
                                $addseo ->meta_description = $request->input('meta_description');
                                $addseo ->save();
                                   
                                return response()->json(["message" => "Products SEO successfully added!"], $this-> successStatus); 
                                         
                    }

                // Store Product Gallery

                public function AddProductGallery(Request $request)
                {
                                
                $validator = Validator::make($request->all(), [ 
                'product_images' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ]);
                                
                if ($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()], 401);            
                }
                                
                $pgallery = new ProductGallery();

                $arr=[];
                foreach ($request->files as $key => $value) {
                    $arr[]=$value;
                }
                dd($arr);
                                                             
                $pgallery ->save();
                                
                return response()->json(["message" => "Product Images successfully added!"], $this-> successStatus); 
                                      
            }               

}
