<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabCheckProduct extends Model
{
    use HasFactory;
    protected $table = 'labcheck_product';
    protected $fillable = [
        'category_id',
        'name',
        'short_description',
        'main_description',
        'sku',
        'inventory_id',
        'discount_id',
        'price',
        'min_qty',
        'max_qty',
        'stock_quantity',
        'main_image',
        'online_status',
    ];
}
