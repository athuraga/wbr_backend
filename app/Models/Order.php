<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = ['order_id','tax','vehicle_id','user_id','payment_token','delivery_person_id','date','time','amount','payment_type','payment_status','vehicle_discount','promocode_id','promocode_price','address_id','vehicle_discount_id','vehicle_discount_price','order_status','delivery_charge','order_start_time','order_end_time','delivery_type','admin_commission','vehicle_amount','vehicle_pending_amount'];

    protected $appends = ['vehicle','user','orderItems','user_address'];

    public function getVehicleAttribute()
    {
        return Vehicle::find($this->vehicle_id);
    }

    public function getUserAttribute()
    {
        return User::find($this->user_id);
    }

    public function getOrderItemsAttribute()
    {
        return OrderChild::where('order_id',$this->attributes['id'])->get();
    }

    public function getUserAddressAttribute()
    {
        return UserAddress::where('id',$this->attributes['address_id'])->first(['lat','lang','address']);
    }
}
