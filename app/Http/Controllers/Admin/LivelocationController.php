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
use App\Models\Livelocation;
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

class LivelocationController extends Controller
{
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return view('admin.livelocation.livelocation',compact('livelocation'));
        }

        /**
         * Display the specified resource.
         *
         * @param  \App\Models\Livelocation  $livelocation
         * @return \Illuminate\Http\Response
         */
        public function show(Livelocation $livelocation)
        {
            return view('admin.livelocation.livelocation',compact('$livelocation'));
        }
}
