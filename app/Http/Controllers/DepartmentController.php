<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();

        return response()->json(DepartmentResource::collection($departments), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $validated = $request->validate();

        try {
            $department = Department::create($validated);
            return response()->json(new DepartmentResource($department), Response::HTTP_CREATED);
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
        $employee = Department::findOrFail($id);
        return response()->json(new DepartmentResource($employee), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, $id)
    {
        $department = Department::findOrFail($id);
        $validated = $request->validate();

        foreach ($validated as $key => $value) {
            $department->{$key}->$value;
        }

        try {
            $department->save();
            return response()->json(new DepartmentResource($department), Response::HTTP_OK);
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
        $department = Department::findOrFail($id);
        try {
            $department->delete();
            return response()->json(null, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(null, Response::HTTP_BAD_REQUEST);
        }
    }
}
