<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Mail\VehicleMail;
use App\Models\Country;
use App\Models\Vehicletype;
use App\Models\DeliveryZoneArea;
use App\Models\GeneralSetting;
use App\Models\Language;
use App\Models\Menu;
use App\Models\Map;
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

class MapController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        Mapper::map(53.381128999999990000, -1.470085000000040000);

        return view('admin.map.map', compact('map'));
    }
}