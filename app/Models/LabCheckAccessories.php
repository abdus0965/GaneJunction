<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabCheckAccessories extends Model
{
    use HasFactory;
    protected $table = 'labcheck_accessories';
    protected $fillable = [
        'labcheck_size',
        'labcheck_color',
        'price',
        'price_type',
        'weight',
        'labcheck_size_image',
        'labcheck_color_image',
    ];
}
