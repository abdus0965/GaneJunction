<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabCheckSEO extends Model
{
    use HasFactory;
    protected $table = 'labcheck_seo';
    protected $fillable = [
        'labcheck_tags',
        'meta_keywords',
        'meta_description',
    ];
}
