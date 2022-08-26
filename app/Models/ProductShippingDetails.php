<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShippingDetails extends Model
{
    use HasFactory;
    protected $table = 'product_shipping_details';
    protected $fillable = [
        'require_shipping',
        'ship_world_wide',
        'width',
        'length',
        'height',
        'unit',
        'weight',
    ];

}
