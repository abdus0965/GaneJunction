<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabCheckGallery extends Model
{
    use HasFactory;
    protected $table = 'labcheck_gallery';
    protected $fillable = [
        'labcheck_images',
    ];
}
