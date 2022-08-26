<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSEO extends Model
{
    use HasFactory;
    protected $table = 'product_seo';
    protected $fillable = [
        'product_tags',
        'meta_keywords',
        'meta_description',
    ];
}
