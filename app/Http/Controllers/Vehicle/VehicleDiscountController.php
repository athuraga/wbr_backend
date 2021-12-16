<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Models\Vehicletype;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Settle;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleDiscount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use DB;

class VehicleDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('vehicle_discount_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id = Vehicle::where('user_id', auth()->user()->id)->first();
        $discounts = VehicleDiscount::where('vehicle_id', $id->id)->get();
        $currency = GeneralSetting::find(1)->currency_symbol;
        return view('vehicle.vehicle discount.vehicle_discount', compact('id', 'discounts','currency'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('vehicle_discount_add'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id = Vehicle::where('user_id', auth()->user()->id)->first();
        return view('vehicle.vehicle discount.create_vehicle_discount', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'discount' => 'bail|required|numeric',
            'max_discount_amount' => 'bail|required|numeric',
            'min_item_amount' => 'bail|required|numeric',
            'type' => 'bail|required',
            'description' => 'bail|required',
        ]);
        $data = $request->all();
        if ($file = $request->hasfile('image'))
        {
            $request->validate(
            ['image' => 'max:1000'],
            [
                'image.max' => 'The Image May Not Be Greater Than 1 MegaBytes.',
            ]);
            $data['image'] = (new CustomController)->uploadImage($request->image);
        } else {
            $data['image'] = 'product_default.jpg';
        }
        $id = VehicleDiscount::create($data);
        return redirect('vehicle/vehicle_discount')->with('msg', 'vehicle discount added successfully..!!');
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
    public function edit(VehicleDiscount $vehicle_discount)
    {
        $vehicleDiscount = $vehicle_discount;
        return view('vehicle.vehicle discount.edit_vehicle_discount', compact('vehicleDiscount'));
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
        $request->validate([
            'discount' => 'bail|required|numeric',
            'max_discount_amount' => 'bail|required|numeric',
            'min_item_amount' => 'bail|required|numeric',
            'type' => 'bail|required',
            'description' => 'bail|required',
        ]);
        $data = $request->all();
        $vehicleDiscount = VehicleDiscount::find($id);
        if ($file = $request->hasfile('image')) {
            $request->validate(
            ['image' => 'max:1000'],
            [
                'image.max' => 'The Image May Not Be Greater Than 1 MegaBytes.',
            ]);
            (new CustomController)->deleteImage(DB::table('vehicle_discount')->where('id', $vehicleDiscount->id)->value('image'));
            $data['image'] = (new CustomController)->uploadImage($request->image);
        }
        $vehicleDiscount->update($data);
        return redirect('vehicle/vehicle_discount')->with('msg', 'vehicle discount updated successfully..!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleDiscount $vehicle_discount)
    {
        $vehicle_discount->delete();
        return response(['success' => true]);
    }

    public function vehicle_finance_details()
    {
        $vehicle = Vehicle::where('user_id', auth()->user()->id)->first();
        $now = Carbon::today();
        $orders = array();
        for ($i = 0; $i < 7; $i++) {
            $order = Order::where('vehicle_id', $vehicle->id)->whereDate('created_at', $now)->get();
            $discount = $order->sum('promocode_price');
            $vehicle_discount = $order->sum('vehicle_discount_price');
            $amount = $order->sum('amount');
            $order['amount'] = $discount + $vehicle_discount + $amount;
            $order['admin_commission'] = $order->sum('admin_commission');
            $order['vehicle_amount'] = $order->sum('vehicle_amount');
            $now =  $now->subDay();
            $order['date'] = $now->toDateString();
            array_push($orders, $order);
        }
        $currency = GeneralSetting::first()->currency_symbol;

        $past = Carbon::now()->subDays(35);
        $now = Carbon::today();
        $c = $now->diffInDays($past);
        $loop = $c / 10;
        $data = [];
        while ($now->greaterThan($past)) {
            $t = $past->copy();
            $t->addDay();
            $temp['start'] = $t->toDateString();
            $past->addDays(10);
            if ($past->greaterThan($now)) {
                $temp['end'] = $now->toDateString();
            } else {
                $temp['end'] = $past->toDateString();
            }
            array_push($data, $temp);
        }

        $settels = array();
        $orderIds = array();
        foreach ($data as $key)
        {
            $settle = Settle::where('vehicle_id', $vehicle->id)->where('created_at', '>=', $key['start'].' 00.00.00')->where('created_at', '<=', $key['end'].' 23.59.59')->get();
            $value['d_total_task'] = $settle->count();
            $value['admin_earning'] = $settle->sum('admin_earning');
            $value['vehicle_earning'] = $settle->sum('vehicle_earning');
            $value['driver_earning'] = $settle->sum('driver_earning');
            $value['d_total_amount'] = $value['admin_earning'] + $value['driver_earning'] + $value['vehicle_earning'];
            $remainingOnline = Settle::where([['vehicle_id', $vehicle->id], ['payment', 0]])->where('created_at', '>=', $key['start'].' 00.00.00')->where('created_at', '<=', $key['end'].' 23.59.59')->get();
            $remainingOffline = Settle::where([['vehicle_id', $vehicle->id], ['payment', 1]])->where('created_at', '>=', $key['start'].' 00.00.00')->where('created_at', '<=', $key['end'].' 23.59.59')->get();

            $online = $remainingOnline->sum('vehicle_earning'); // admin e devana
            $offline = $remainingOffline->sum('admin_earning'); // admin e levana

            $value['duration'] = $key['start'] . ' - ' . $key['end'];
            $value['d_balance'] = $offline - $online; // + hoy to levana - devana
            array_push($settels,$value);
        }
        return view('vehicle.vehicle.finance_details',compact('vehicle','orders','currency','settels'));
    }
}