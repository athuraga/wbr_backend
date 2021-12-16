<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleDiscount extends Model
{
    use HasFactory;

    protected $table = 'vehicle_discount';

    protected $fillable = ['image','vehicle_id','type','discount','min_item_amount','max_discount_amount','start_end_date','description'];
}
