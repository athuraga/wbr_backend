<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleBankDetail extends Model
{
    use HasFactory;

    protected $table = 'vehicle_bank_details';

    protected $fillable = ['vehicle_id','bank_name','clabe','branch_name','account_number','ifsc_code'];
}
