<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectorDetails extends Model
{
    use HasFactory;
    
    protected $table = 'director_details';
    protected $fillable = [
        'member_id',
        'director_name',
        'director_passport_no',
        'director_passport_copy',
    ];
}
