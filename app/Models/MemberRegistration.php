<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberRegistration extends Model
{
    use HasFactory;

    protected $table = 'member_registration';
    protected $fillable = [
        'member_id',
        'ic_passport_no',
        'ic_passport_photo',
        'country',
        'default_currency',
        'address1',
        'address2',
        'city',
        'zip_code',
        'state_region',
        'phone_no',
        'email',
        'account_referral_code',
        'account_type',
        'company_name',
        'company_reg_no',
        'business_nature',
        'company_description',
        'ssm_form',
        'utility_bill',
        'partner_code',
        'shop_logo',
        'shop_name',
        'shop_description',
        'selling_item_type',
        'status',
    ];
}
