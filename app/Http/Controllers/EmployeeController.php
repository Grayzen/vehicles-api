<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Employee::with('vehicle')->orderBy('name')->get());
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
            // "company_id"  => "required|integer",
            'name'        => 'required|string|max:100',
            "surname"     => "required|string|max:100",
            "email"       => "required|string|email|max:191",
        ]);

        try{
            if(Employee::create($request->all()))
                return response()->json(['status' => 'success', 'message' => 'Employee Created Successfully']);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error on Employee Creation']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            return response()->json(Employee::with('vehicle')->findOrFail($id));
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error on Employee Show!']);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // "company_id"  => "required|integer",
            'name'        => 'required|string|max:100',
            "surname"     => "required|string|max:100",
            "email"       => "required|string|email|max:191",
        ]);

        try{
            if(Employee::findOrFail($id)->update($request->all()))
                return response()->json(['status' => 'success', 'message' => 'Employee Updated Successfully']);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error on Employee Update!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $employee = Employee::findOrFail($id);
            if($employee->delete()){
                Vehicle::where('employee_id', $id)->update(['employee_id' => NULL]);
                return response()->json(['status' => 'success', 'message' => 'Employee Deleted Successfully']);
            }
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error on Employee Deletion']);
        }
    }
}
