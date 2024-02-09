<?php

namespace Modules\Teacher\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route()->teacher;

        $rule = [
            'name' => 'required|max:255|unique:teachers,name',
            'slug' => 'required|max:255',
            'description' => 'required',
            'exp' => 'required|integer',
            'image' => 'required|max:255',
        ];

        if($id){
            $rule['name'] = 'required|max:255|unique:teachers,name,'.$id;
        }

        return $rule;
    }

    public function messages(){
        return [
            'required' => __('teacher::validation.required'),
            'max' => __('teacher::validation.max'),
            'unique' => __('teacher::validation.unique'),
            'integer' => __('teacher::validation.integer')
        ];
    }

    public function attributes(){
        return __('teacher::validation.attributes');
    }
}
