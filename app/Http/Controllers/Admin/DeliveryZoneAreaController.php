<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryPerson;
use App\Models\DeliveryZone;
use App\Models\DeliveryZoneArea;
use App\Models\Vehicle;

use Illuminate\Http\Request;
use Auth;

class   DeliveryZoneAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $delivery_zone = DeliveryZone::find($id);
        $areas = DeliveryZoneArea::where('delivery_zone_id',$id)->get();
        $vehicles = Vehicle::where('status',1)->get();
        $delivery_persons = DeliveryPerson::where('delivery_zone_id',$id)->get();
        return view('admin.delivery zone area.delivery_zone_area',compact('delivery_zone','areas','vehicles','delivery_persons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if (Auth::user()->load('roles')->roles->contains('title', 'admin')) {
            $request->validate([
                'name' => 'required',
                'radius' => 'required|numeric',
                'location' => 'required',
                'vehicle_id' => 'required',
            ]);
            $data['vehicle_id'] = implode(',',$data['vehicle_id']);
        }

        if (Auth::user()->load('roles')->roles->contains('title', 'vehicle')) {
            $request->validate([
                'name' => 'required',
                'radius' => 'required|numeric',
                'location' => 'required',
            ]);
            $vehicle = Vehicle::where('user_id',auth()->user()->id)->first();
            $data['vehicle_id'] = $vehicle->id;
        }
        DeliveryZoneArea::create($data);
        return response(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
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
        $delivery_zone = DeliveryZoneArea::find($id);
        return response(['success' => true , 'data' => $delivery_zone]);
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
        $data = $request->all();
        $id = DeliveryZoneArea::find($id);
        if (Auth::user()->load('roles')->roles->contains('title', 'admin')) {
            $request->validate([
                'name' => 'required',
                'radius' => 'required|numeric',
                'location' => 'required',
                'vehicle_id' => 'required',
            ]);
            $data['vehicle_id'] = implode(',',$data['vehicle_id']);
        }

        if (Auth::user()->load('roles')->roles->contains('title', 'vehicle')) {
            $request->validate([
                'name' => 'required',
                'radius' => 'required|numeric',
                'location' => 'required',
            ]);
            $vehicle = Vehicle::where('user_id',auth()->user()->id)->first();
            $data['vehicle_id'] = $vehicle->id;
        }
        $id->update($data);
        return response(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = DeliveryZoneArea::find($id);
        $id->delete();
        return response(['success' => true]);
    }

    public function delivery_zone_area_map($id)
    {
        $delivery_zone = DeliveryZoneArea::find($id);
        return response(['success' => true , 'data' => $delivery_zone]);
    }
}