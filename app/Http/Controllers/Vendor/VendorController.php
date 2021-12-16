<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Models\Cuisine;
use App\Models\GeneralSetting;
use App\Models\Language;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\Review;
use App\Models\Role;
use App\Models\Settle;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleBankDetail;
use App\Models\WorkingHours;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicle = Vehicle::where('user_id', auth()->user()->id)->first();
        $vehicle['menu'] = Menu::where('vehicle_id', auth()->user()->id)->get();
        return view('vehicle.vehicle.show_vehicle', compact('vehicle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $vehicle = Vehicle::where('user_id', auth()->user()->id)->first();
        // $cuisines = Cuisine::where('status', 1)->get();
        // $languages = Language::whereStatus(1)->get();
        // return view('vehicle.vehicle.edit_vehicle', compact('vehicle', 'cuisines','languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);
        $request->validate([
            'name' => 'required',
            'cuisine_id' => 'bail|required',
            'address' => 'required',
            'min_order_amount' => 'required',
            'for_two_person' => 'required',
            'avg_delivery_time' => 'required',
            'license_number' => 'required',
            'vehicle_type' => 'required',
            'time_slot' => 'required',
            'contact' => 'required|max:15'
        ]);
        $data = $request->all();
        $data['cuisine_id'] = implode(',', $request->cuisine_id);
        $user = User::find($vehicle->user_id);
        $user->phone_code = $request->phone_code;
        $user->phone = $request->phone;
        $user->save();
        if ($file = $request->hasfile('image'))
        {
            $request->validate(
            ['image' => 'max:1000'],
            [
                'image.max' => 'The Image May Not Be Greater Than 1 MegaBytes.',
            ]);
            (new CustomController)->deleteImage(DB::table('vehicle')->where('id', $vehicle['id'])->value('image'));
            $data['image'] = (new CustomController)->uploadImage($request->image);
        }
        if ($file = $request->hasfile('vehicle_logo'))
        {
            $request->validate(
            ['vehicle_logo' => 'max:1000'],
            [
                'vehicle_logo.max' => 'The Image May Not Be Greater Than 1 MegaBytes.',
            ]);
            (new CustomController)->deleteImage(DB::table('vehicle')->where('id', $vehicle['id'])->value('vehicle_logo'));
            $data['vehicle_logo'] = (new CustomController)->uploadImage($request->vehicle_logo);
        }
        if (isset($data['status'])) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        $vehicle->update($data);
        return redirect('vehicle/vehicle_home')->with('msg','Vehicle Profile Update successfully..!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delivery_timeslot()
    {
        $user_id = auth()->user()->id;
        $vehicle = Vehicle::where('user_id', $user_id)->first();
        $setting = GeneralSetting::first();
        $start_time = carbon::parse($setting["start_time"])->format('h:i a');
        $end_time = carbon::parse($setting["end_time"])->format('h:i a');
        $data = WorkingHours::where([['vehicle_id', $vehicle->id], ['type', 'delivery_time']])->get();
        return view('vehicle.vehicle.edit_delivery_time', compact('vehicle', 'setting', 'start_time', 'end_time', 'data'));
    }

    public function pickup_timeslot()
    {
        $user_id = auth()->user()->id;
        $vehicle = Vehicle::where('user_id', $user_id)->first();
        $setting = GeneralSetting::first();
        $start_time = carbon::parse($setting["start_time"])->format('h:i a');
        $end_time = carbon::parse($setting["end_time"])->format('h:i a');
        $data = WorkingHours::where([['vehicle_id', $vehicle->id], ['type', 'pick_up_time']])->get();
        return view('vehicle.vehicle.edit_pick_up_time', compact('vehicle', 'setting', 'start_time', 'end_time', 'data'));
    }

    public function selling_timeslot()
    {
        $user_id = auth()->user()->id;
        $vehicle = Vehicle::where('user_id', $user_id)->first();
        $setting = GeneralSetting::first();
        $start_time = carbon::parse($setting["start_time"])->format('h:i a');
        $end_time = carbon::parse($setting["end_time"])->format('h:i a');
        $data = WorkingHours::where([['vehicle_id', $vehicle->id], ['type', 'selling_timeslot']])->get();
        return view('vehicle.vehicle.edit_selling_timeslot', compact('vehicle', 'setting', 'start_time', 'end_time', 'data'));
    }

    public function month_finanace()
    {
        $vehicle = Vehicle::where('user_id',auth()->user()->id)->first();
        $days = Carbon::now()->daysInMonth;
        $now = Carbon::now()->endOfMonth();
        $orders = array();
        for ($i = 0; $i < $days; $i++)
        {
            $order = Order::where([['vehicle_id',$vehicle->id],['order_status','COMPLETE']])->whereDate('created_at', $now)->get();
            $discount = $order->sum('promocode_price');
            $vehicle_discount = $order->sum('vehicle_discount_price');
            $amount = $order->sum('amount');
            $order['amount'] = $discount + $vehicle_discount + $amount;
            $order['admin_commission'] = $order->sum('admin_commission');
            $order['vehicle_amount'] = $order->sum('vehicle_amount');
            $order['date'] = $now->toDateString();
            array_push($orders, $order);
            $now =  $now->subDay();
        }
        $now = Carbon::today();
        $month = $now->month;
        $currency = GeneralSetting::first()->currency_symbol;
        return view('vehicle.vehicle.month_finance', compact('month', 'orders', 'currency'));
    }

    public function month(Request $request)
    {
        $data = $request->all();
        $days = Carbon::parse($data['year'].'-'.$data['month'].'-01')->daysInMonth;
        $now = Carbon::parse($data['year'].'-'.$data['month'].'-01')->endOfMonth();
        $orders = array();
        for ($i = 0; $i < $days; $i++)
        {
            $order = Order::whereDate('created_at',$now)->get();
            $discount = $order->sum('promocode_price');
            $vehicle_discount = $order->sum('vehicle_discount_price');
            $amount = $order->sum('amount');
            $order['amount'] = $discount + $vehicle_discount + $amount;
            $order['admin_commission'] = $order->sum('admin_commission');
            $order['vehicle_amount'] = $order->sum('vehicle_amount');
            $order['date'] = $now->toDateString();
            array_push($orders, $order);
            $now =  $now->subDay();
        }
        $now = $now = Carbon::parse($data['year'].'-'.$data['month'].'-01');
        $month = $now->month;
        $currency = GeneralSetting::first()->currency_symbol;
        return view('vehicle.vehicle.month', compact('month', 'orders', 'currency'));
    }

    public function transaction($duration)
    {
        $duration = explode(' - ',$duration);
        $settles = Settle::where('created_at', '>=', $duration[0])->where('created_at', '<=', $duration[1])->get();
    }

    public function bank_details()
    {
        $vehicle = Vehicle::where('user_id',auth()->user()->id)->first();
        $bank_details = VehicleBankDetail::where('vehicle_id',$vehicle->id)->first();
        if($bank_details)
        {
            return view('vehicle.vehicle_bank_detail.update_bank_detail',compact('vehicle','bank_details'));
        }
        else
        {
            return view('vehicle.vehicle_bank_detail.create_bank_detail',compact('vehicle'));
        }
    }

    public function add_vehicle_bank_details(Request $request)
    {
        $request->validate(
            [
                'bank_name' => 'bail|required',
                'branch_name' => 'bail|required',
                'ifsc_code' => 'bail|required|regex:/^[A-Za-z]{4}\d{7}$/',
                'clabe' => 'bail|required|numeric|digits:18',
                'account_number' => 'bail|required'
            ],
            [
                'ifsc_code.required' => 'IFSC Code Field Is Required.',
                'ifsc_code.regex' => 'IFSC Code Invalid.',
            ],
            );
        $data = $request->all();
        $details = VehicleBankDetail::create($data);
        return redirect()->back()->with('msg','vehicle bank Detail updated successfully');
    }

    public function edit_vehicle_bank_details(Request $request,$id)
    {
        $request->validate(
            [
                'bank_name' => 'bail|required',
                'branch_name' => 'bail|required',
                'ifsc_code' => 'bail|required|regex:/^[A-Za-z]{4}\d{7}$/',
                'clabe' => 'bail|required|numeric|digits:18',
                'account_number' => 'bail|required'
            ],
            [
                'ifsc_code.required' => 'IFSC Code Field Is Required.',
                'ifsc_code.regex' => 'IFSC Code Invalid.',
            ],
            );
        $data = VehicleBankDetail::find($id);
        $data->update($request->all());
        return redirect()->back()->with('msg','vehicle bank Detail updated successfully');
    }

    public function rattings()
    {
        $vehicle = Vehicle::where('user_id',auth()->user()->id)->first();
        $reviews = Review::where('vehicle_id',$vehicle->id)->get();
        return view('vehicle.vehicle.ratting',compact('reviews','vehicle'));
    }

    public function add_user(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'email_id' => 'bail|required|email|unique:users',
            'password' => 'bail|required|min:6',
            'phone' => 'bail|required|numeric|digits_between:6,12',
        ]);
        $data = $request->all();
        $data['status'] = 1;
        $data['is_verified'] = 1;
        $data['image'] = 'noimage.png';
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $role_id = Role::where('title','User')->orWhere('title','user')->first();
        $user->roles()->sync($role_id);
        return response(['success' => true , 'data' => $user]);
    }
}
