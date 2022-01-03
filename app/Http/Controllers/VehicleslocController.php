<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Mail\VehicleMail;
use App\Models\Country;
use App\Models\Vehicletype;
use App\Models\DeliveryZoneArea;
use App\Models\GeneralSetting;
use App\Models\Language;
use App\Models\Menu;
use App\Models\Vehiclesloc;
use App\Models\PromoCode;
use App\Models\Review;
use App\Models\Role;
use App\Models\Settle;
use App\Models\Submenu;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\WorkingHours;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use DB;
use Mapper;

class VehicleslocController extends Controller
{
    public function index()
    {
        //$vehicleloc = Vehicleloc::where('vehicle')->get();
        $vehiclelocs = Vehicle::get(['id', 'image', 'name', 'lat', 'lang', 'vehicletype_id', 'license_number'])->makeHidden(['vehicle_logo']);
        //     foreach ($vehiclelocs as $vehicleloc) {
        //         $vehicleloc['lat'] = $vehicleloc->lat;
        //         $vehicleloc['lng'] = $vehicleloc->lang;
        //     }
        // return response(['success' => true , 'data' => $vehiclelocs]);
        $vehicleslocation = $vehiclelocs;
        return json_encode(array('data'=>$vehicleslocation));;
        // return Vehiclesloc::all();
    }


}