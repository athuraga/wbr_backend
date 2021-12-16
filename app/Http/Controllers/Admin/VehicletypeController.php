<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use App\Imports\CusineImport;
use App\Mail\Verification;
use App\Models\Vehicletype;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gate;
use DB;
use Mail;
use Symfony\Component\HttpFoundation\Response;


class VehicletypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('vehicletype_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vehicletypes = Vehicletype::orderBy('id','DESC')->get();
        return view('admin.vehicletype.vehicletype',compact('vehicletypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('vehicletype_add'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.vehicletype.create_vehicletype');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
        ['name' => 'required','unique:vehicletype'],
        [
            'name.required' => 'The Name Of Vehicletype Field Is Required',
        ]);
        $data = $request->all();
        if(isset($data['status']))
        {
            $data['status'] = 1;
        }
        else
        {
            $data['status'] = 0;
        }
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
        Vehicletype::create($data);
        return redirect('admin/vehicletype')->with('msg','Vehicletype created successfully..!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicletype  $vehicletype
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicletype $vehicletype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicletype  $vehicletype
     * @return \Illuminate\Http\Response
     */

    public function edit(Vehicletype $vehicletype)
    {
        abort_if(Gate::denies('vehicletype_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.vehicletype.edit_vehicletype',compact('vehicletype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicletype  $vehicletype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicletype $vehicletype)
    {
        $request->validate(
        ['name' => 'required','unique:vehicletype,name,' . $vehicletype . ',id'],
        [
            'name.required' => 'The Name Of Vehicletype Field Is Required',
        ]);
        $data = $request->all();
        if ($file = $request->hasfile('image'))
        {
            $request->validate(
            ['image' => 'max:1000'],
            [
                'image.max' => 'The Image May Not Be Greater Than 1 MegaBytes.',
            ]);
            (new CustomController)->deleteImage(DB::table('vehicletype')->where('id', $vehicletype->id)->value('image'));
            $data['image'] = (new CustomController)->uploadImage($request->image);
        }
        $vehicletype->update($data);
        return redirect('admin/vehicletype')->with('msg','Vehicletype updated successfully..!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicletype  $vehicletype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicletype $vehicletype)
    {
        $cusine = Vehicletype::find($vehicletype);
        $vehicles = Vehicle::all();
        foreach ($vehicles as $value)
        {
            $cIds = explode(',',$value->vehicletype_id);
            if(count($cIds) > 0)
            {
                if (($key = array_search($vehicletype->id, $cIds)) !== false)
                {
                    return response(['success' => false , 'data' => __('this vehicletypes connected with vehicle first delete vehicle')]);
                }
            }
        }
        (new CustomController)->deleteImage(DB::table('vehicletype')->where('id', $vehicletype->id)->value('image'));
        $vehicletype->delete();
        return response(['success' => true]);
    }

    public function change_status(Request $request)
    {
        $data = Vehicletype::find($request->id);

        if($data->status == 0)
        {
            $data->status = 1;
            $data->save();
            return response(['success' => true]);
        }
        if($data->status == 1)
        {
            $data->status = 0;
            $data->save();
            return response(['success' => true]);
        }
    }
}