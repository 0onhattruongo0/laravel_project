<?php

namespace Modules\Courses\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
 
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
        $id = $this->route()->course;
        $rule = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'detail' => 'required',
            'teacher_id' => ['required','integer', function($attribute, $value, $fail){
                if($value == 0){
                    $fail( __('courses::validation.choose'));
                }
            }],
            'thumbnail' => 'required|max:255',
            'code' => 'required|max:255|unique:courses,code',
            'is_document' => 'required|integer',
            'supports' => 'required',
            'status' => 'required|integer',
            'categories' => 'required'
        ];

        if($id){
            $rule['code'] = 'required|max:255|unique:courses,code,'.$id;
        }

        return $rule;
    }

    public function messages(){
        return [
            'required' => __('courses::validation.required'),
            'max' => __('courses::validation.max'),
            'min' => __('courses::validation.min'),
            'integer' => __('courses::validation.integer'),
            'unique' => __('courses::validation.unique')
        ];
    }

    public function attributes(){
        // return [
        //     'name' => __('courses::validation.attributes.name'),
        //     'slug' => __('courses::validation.attributes.slug'),
        //     'detail' => __('courses::validation.attributes.detail'),
        //     'teacher_id' => __('courses::validation.attributes.teacher_id'),
        //     'thumbnail' => __('courses::validation.attributes.thumbnail'),
        //     'code' => __('courses::validation.attributes.code'),
        //     'is_document' => __('courses::validation.attributes.is_document'),
        //     'supports' => __('courses::validation.attributes.supports'),
        //     'status' => __('courses::validation.attributes.status'),
        // ];
        return __('courses::validation.attributes');
    }
}
