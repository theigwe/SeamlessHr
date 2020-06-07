<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'role' => $this->role,
            'status' => $this->status,
            'staff_type' => $this->staff_type,
            'salary' => $this->salary,
            'salary_currency' => $this->salary_currency,
            'department_id' => $this->department_id,
            'employment_date' => $this->employment_date,
            'joined' => $this->created_at->diffForHumans(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'department' => $this->department
        ];
    }
}
