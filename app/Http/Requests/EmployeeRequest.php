<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'department_id' => 'required|integer|exists:departments,id',
            'full_name' => 'required|string|max:100|min:3',
            'role' => 'required|string|min:3|max:100',
            'employment_date' => 'required|date',
            'staff_type' => [
                'required',
                Rule::in(['contract', 'full time', 'part time'])
            ],
            'status' => [
                'required',
                Rule::in(['probation', 'sacked', 'dismissed', 'worker'])
            ],
            'salary_currency' => [
                'nullable',
                Rule::in(['NGN', 'USD'])
            ],
            'salary' => 'required|numeric'
        ];
    }
}
