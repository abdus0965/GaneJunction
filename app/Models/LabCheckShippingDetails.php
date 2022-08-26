<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabCheckShippingDetails extends Model
{
    use HasFactory;
    protected $table = 'labcheck_shipping_details';
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
