<?php

namespace App\Http\Requests\FollowupTarget;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssign extends FormRequest
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
          'target_id' => 'required',
          'coach_id' => 'required',
          'reason_id' => 'required',
        ];
    }

    public function messages() {
      return [
          'target_id.required' => 'Please select a target',
          'coach_id.required' => 'The coach field is required',
          'reason_id.required' => 'The reason field is required',
      ];
    }
}
