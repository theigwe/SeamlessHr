<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();

        return response()->json(EmployeeResource::collection($employees), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $validated = $request->validate();

        try {
            $employee = Employee::create($validated);
            return response()->json(new EmployeeResource($employee), Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json(null, Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json(new EmployeeResource($employee), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $validated = $request->validate();

        foreach ($validated as $key => $value) {
            $employee->{$key}->$value;
        }

        try {
            $employee->save();
            return response()->json(new EmployeeResource($employee), Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(null, Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        try {
            $employee->delete();
            return response()->json(null, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(null, Response::HTTP_BAD_REQUEST);
        }
    }
}
