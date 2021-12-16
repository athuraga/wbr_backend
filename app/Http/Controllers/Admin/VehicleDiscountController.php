<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Models\GeneralSetting;
use App\Models\Vehicle;
use App\Models\VehicleDiscount;
use Illuminate\Http\Request;
use DB;

class VehicleDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $discounts = VehicleDiscount::where('vehicle_id',$id)->get();
        $currency = GeneralSetting::find(1)->currency_symbol;
        return view('admin.vehicle discount.vehicle_discount',compact('id','discounts','currency'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('admin.vehicle discount.create_vehicle_discount',compact('id'));
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
        }
        else
        {
            $data['image'] = 'product_default.jpg';
        }
        $id = VehicleDiscount::create($data);
        return redirect('admin/vehicle_discount/'.$id->vehicle_id)->with('msg','vehicle discount added successfully..!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleDiscount  $vehicleDiscount
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleDiscount $vehicleDiscount)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleDiscount  $vehicleDiscount
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleDiscount $vehicleDiscount)
    {
        return view('admin.vehicle discount.edit_vehicle_discount',compact('vehicleDiscount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleDiscount  $vehicleDiscount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleDiscount $vehicleDiscount)
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
            (new CustomController)->deleteImage(DB::table('vehicle_discount')->where('id', $vehicleDiscount->id)->value('image'));
            $data['image'] = (new CustomController)->uploadImage($request->image);
        }
        $vehicleDiscount->update($data);
        return redirect('admin/vehicle_discount/'.$vehicleDiscount->vehicle_id)->with('msg','vehicle discount updated successfully..!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleDiscount  $vehicleDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleDiscount $vehicleDiscount)
    {

    }

}
