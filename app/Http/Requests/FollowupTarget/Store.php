<?php

namespace App\Http\Requests\FollowupTarget;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'age_profile_id' => 'required',
            'church_id' => 'required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'fname.required' => 'This field is required',
            'lname.required' => 'This field is required',
            'phone.required' => 'This field is required',
            'age_profile_id.required' => 'This field is required',
            'church_id.required' => 'This field is required',
        ];
    }
}
