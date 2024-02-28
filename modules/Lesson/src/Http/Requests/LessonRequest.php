<?php

namespace Modules\Lesson\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
        $rule = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'video' => 'required|max:255',
            'is_trial' => 'required|integer',
        ];
        return $rule;
    }

    public function messages()
    {
        return [
            'required' => __('lesson::validation.required'),
            'max' => __('lesson::validation.max'),
            'integer' => __('lesson::validation.integer'),
        ];
    }
    public function attributes()
    {
        return  __('lesson::validation.attributes');
    }
}
