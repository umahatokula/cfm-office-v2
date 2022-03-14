<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffBankDetailRequest extends FormRequest
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
            'staff_id' => 'required',
            'bank_id' => 'required',
            'account_number' => 'required',
            'account_name' => 'required',
            'is_primary' => 'boolean',
        ];
    }

    public function prepareForValidation() {
        $this->merge([
            'is_primary' => $this->boolean('is_primary')
        ]);
    }
}
