<?php

namespace Modules\Student\src\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class RegisterStudentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (Auth::guard('student')->user()) {
            return [
                'name' => 'required|max:255',
                'phone' => 'required|regex:/^0[0-9]{9}$/',
                'address' => 'required'
            ];
        }
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6',
            'phone' => 'required|regex:/^0[0-9]{9}$/',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('student::validation.required'),
            'max' => __('student::validation.max'),
            'email' => __('student::validation.email'),
            'unique' => __('student::validation.unique'),
            'min' => __('student::validation.min'),
            'regex' => __('student::validation.regex')
        ];
    }

    public function attributes()
    {
        return __('student::validation.attributes');
    }
}
