<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAccessories extends Model
{
    use HasFactory;
    protected $table = 'product_accessories';
    protected $fillable = [
        'product_size',
        'product_color',
        'price',
        'price_type',
        'weight',
        'product_size_image',
        'product_color_image',
    ];
}
