<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Company::with('employees', 'employees.vehicles')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            if(Company::create($request->all()))
                return response()->json(['status' => 'success', 'message' => 'Company Created Successfully']);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error on Company Creation!']);
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
            return response()->json(Company::with('employees', 'employees.vehicles')->findOrFail($id));
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error on Company Show!']);
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
        try{
            if(Company::findOrFail($id)->update($request->all()))
                return response()->json(['status' => 'success', 'message' => 'Company Updated Successfully']);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error on Company Update!']);
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
            if(Company::findOrFail($id)->delete())
                return response()->json(['status' => 'success', 'message' => 'Company Deleted Successfully']);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error on Company Delete!']);
        }
    }
}
