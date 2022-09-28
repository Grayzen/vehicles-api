<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return response()->json(Vehicle::with('employee')->orderByDesc('year')->get());
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error on Vehicles!']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'employee_id'      => 'required|integer',
            // "vehicle_type"     => "required|string",
            "vin"              => "required|string|min:10",
            "registration_no"  => "required|string",
            "type"             => "required|string",
            "fuel"             => "required|string",
            "brand"            => "required|string",
            "model"            => "required|string",
            "year"             => "required|integer|min:1950|max:2022",
        ]);

        try{
            if(Vehicle::create($request->all()))
                return response()->json(['status' => 'success', 'message' => 'Vehicle Created Successfully']);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error on Vehicle Creation!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            return response()->json(Vehicle::with('employee')->findOrFail($id));
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error on Vehicle Show!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            // 'employee_id'      => 'required|integer',
            // "vehicle_type"     => "required|string",
            "vin"              => "required|string|min:10",
            "registration_no"  => "required|string",
            "type"             => "required|string",
            "fuel"             => "required|string",
            "brand"            => "required|string",
            "model"            => "required|string",
            "year"             => "required|integer|min:1950|max:2022",
        ]);

        try{
            $vehicle = Vehicle::where('employee_id', $request->employee_id)->update(['employee_id' => NULL]);
            if(Vehicle::findOrFail($id)->update($request->all())){
                return response()->json(['status' => 'success', 'message' => 'Vehicle Updated Successfully']);
            }
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error on Vehicle Update!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            if(Vehicle::findOrFail($id)->delete())
                return response()->json(['status' => 'success', 'message' => 'Vehicle Deleted Successfully']);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error on Vehicle Delete!']);
        }
    }
}
