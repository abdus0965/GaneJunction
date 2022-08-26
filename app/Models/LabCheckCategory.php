<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabCheckCategory extends Model
{
    use HasFactory;
    protected $table = 'labcheck_category';
    protected $fillable = [
        'name',
    ];
}
