<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicle';

    protected $fillable = ['name','vehicle_own_driver','vehicle_language','image','vehicle_logo','user_id','email_id','password','contact','vehicletype_id','address','lat','lang','map_address','min_order_amount','for_two_person','avg_delivery_time','license_number','admin_comission_type','admin_comission_value','vehicle_type','time_slot','tax','delivery_type_timeSlot','status','isExplorer','isTop','connector_type','connector_descriptor','connector_port'];

    protected $appends = ['image','vehicletype','vehicle_logo','rate','review'];

    public function getImageAttribute()
    {
        return url('images/upload') . '/'.$this->attributes['image'];
    }

    public function getVehicletypeAttribute()
    {
        // if ($this->vehicletype_id != null)
        // {
            $vehicletypeIds = explode(",",$this->vehicletype_id);
            $vehicletype = [];
            foreach ($vehicletypeIds as $id)
            {
                array_push($vehicletype, Vehicletype::where('id',$id)->first(['name','image']));
            }
            return $vehicletype;
        // }
    }

    public function getVehicleLogoAttribute()
    {
        return url('images/upload') . '/'.$this->attributes['vehicle_logo'];
    }

    public function getRateAttribute()
    {
        $review = Review::where('vehicle_id',$this->attributes['id'])->get();
        if (count($review) > 0) {
            $totalRate = 0;
            foreach ($review as $r)
            {
                $totalRate = $totalRate + $r->rate;
            }
            return round($totalRate / count($review), 1);
        }
        else
        {
            return 0;
        }
    }

    public function getReviewAttribute()
    {
        return Review::where('vehicle_id',$this->attributes['id'])->count();
    }

    public function scopeGetByDistance($query, $lat, $lang, $radius)
    {
        $results = DB::select(DB::raw('SELECT id, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( lang ) - radians(' . $lang . ') ) + sin( radians(' . $lat . ') ) * sin( radians(lat) ) ) ) AS distance FROM vehicle HAVING distance < ' . $radius . ' ORDER BY distance'));
        if (!empty($results))
        {
            $ids = [];
            //Extract the id's
            foreach ($results as $q)
            {
                array_push($ids, $q->id);
            }
            return $query->whereIn('id', $ids);
        }
        return $query->whereIn('id', []);
    }
}