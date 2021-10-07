<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
            'fname'          => 'min:2|max:255|required',
            'lname'          => 'min:2|max:255|required',
            'email'          => 'min:2|email',
            'gender_id'      => 'required',
            'country_id'     => 'required',
            'church_id'      => 'required',
            'age_profile_id' => 'required',
            'region_id'      => 'required'
        ];
    }
}
