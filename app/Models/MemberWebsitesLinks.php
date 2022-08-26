<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberWebsitesLinks extends Model
{
    use HasFactory;
    protected $table = 'websites_link';
    protected $fillable = [
        'member_id',
        'social_page_link',
    ];
}
