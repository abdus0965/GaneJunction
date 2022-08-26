<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleVendor extends Model
{
    use HasFactory;

    protected $table = 'role_vendor';
    protected $fillable = [
        'role_id',
        'vendor_id',
        'status',
    ];
}
