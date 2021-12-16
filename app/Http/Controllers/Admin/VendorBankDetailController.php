<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleBankDetail;
use Illuminate\Http\Request;

class VehicleBankDetailController extends Controller
{
    public function vehicle_bank_details($id)
    {
        $bank_details = VehicleBankDetail::where('vehicle_id',$id)->first();
        $vehicle = Vehicle::find($id);
        if($bank_details)
        {
            return view('admin.vehicle_bank_detail.update_bank_detail',compact('vehicle','bank_details'));
        }
        else
        {
            return view('admin.vehicle_bank_detail.create_bank_detail',compact('vehicle'));
        }
    }

    public function add_bank_details(Request $request)
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
        return redirect('admin/vehicle/'.$details->vehicle_id)->with('msg','vehicle bank Detail updated successfully');
    }

    public function update_bank_details(Request $request,$id)
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
        return redirect('admin/vehicle/'.$data->vehicle_id)->with('msg','vehicle bank Detail updated successfully');
    }
}
