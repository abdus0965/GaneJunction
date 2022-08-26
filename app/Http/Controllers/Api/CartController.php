<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem; 
use App\Models\OrderItems;
use App\Models\OrderDetails;
use App\Models\PaymentDetails;
use Validator;

class CartController extends Controller
{
    public $successStatus = 200;

        // Add to cart

        public function AddtoCart(Request $request)
        {
       
               $validator = Validator::make($request->all(), [ 
                  'user_id'=>'required',
                  'product_id'=>'required',
                  'quantity'=>'required',
               ]);
       
               if ($validator->fails()) { 
                   return response()->json(['error'=>$validator->errors()], 401);            
   }
       
               $addcart = new CartItem();       
               $addcart ->user_id = $request->input('user_id');
               $addcart ->product_id = $request->input('product_id'); 
               $addcart ->quantity = $request->input('quantity');    
               $addcart ->save();
       
               return response()->json(["message" => "Item successfully added!"], $this-> successStatus); 
             
        }

        // add order item
        
        public function AddOrderItem(Request $request)
        {
       
               $validator = Validator::make($request->all(), [ 
                  'order_id'=>'required',
                  'product_id'=>'required',
               ]);
       
               if ($validator->fails()) { 
                   return response()->json(['error'=>$validator->errors()], 401);            
    }
       
               $orderitem = new OrderItems();       
               $orderitem ->order_id = $request->input('order_id');
               $orderitem ->product_id = $request->input('product_id');   
               $orderitem ->save();
       
               return response()->json(["message" => "Item successfully added!"], $this-> successStatus); 
             
      }

         // add order Details
        
         public function AddOrderDetails(Request $request)
         {
        
                $validator = Validator::make($request->all(), [ 
                   'user_id'=>'required',
                   'total'=>'required',
                   'payment_id'=>'required',
                ]);
        
                if ($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()], 401);            
     }
        
                $orderdetails = new OrderDetails();       
                $orderdetails ->user_id = $request->input('user_id');
                $orderdetails ->total = $request->input('total');  
                $orderdetails ->payment_id = $request->input('payment_id');  
                $orderdetails ->save();
        
                return response()->json(["message" => "Order details successfully added!"], $this-> successStatus); 
              
         }

          // add Payment Details
        
          public function PaymentDetails(Request $request)
          {
         
                 $validator = Validator::make($request->all(), [ 
                    'order_id'=>'required',
                    'amount'=>'required',
                    'provider'=>'required',
                    'status' => "0"
                 ]);
         
                 if ($validator->fails()) { 
                     return response()->json(['error'=>$validator->errors()], 401);            
      }
         
                 $orderdetails = new PaymentDetails();       
                 $orderdetails ->order_id = $request->input('order_id');
                 $orderdetails ->amount = $request->input('amount');  
                 $orderdetails ->provider = $request->input('provider');  
                 $orderdetails ->save();

                 return response()->json(["message" => "payment details successfully added!"], $this-> successStatus); 
               
          }
}
