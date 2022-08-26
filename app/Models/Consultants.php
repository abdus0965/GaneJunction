<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultants extends Model
{
    use HasFactory;
    protected $table = 'consultants';
    protected $fillable = [
        'user_id',
        'vendor_id',
        'name',
        'status',
    ];
}
