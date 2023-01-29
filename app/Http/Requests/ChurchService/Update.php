<?php

namespace App\Http\Requests\ChurchService;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'service_type_id'                         => 'numeric|required',
            'service_date'                            => 'required',
            'attendance_men'                          => 'numeric|required',
            'attendance_women'                        => 'numeric|required',
            'attendance_children'                     => 'numeric|required',
            'first_timers_men'                        => 'numeric|required',
            'first_timers_women'                      => 'numeric|required',
            'first_timers_children'                   => 'numeric|required',
            'born_again_men'                          => 'numeric|required',
            'born_again_women'                        => 'numeric|required',
            'born_again_children'                     => 'numeric|required',
            'filled_men'                              => 'numeric|required',
            'filled_women'                            => 'numeric|required',
            'filled_children'                         => 'numeric|required',
            'regular_offering'                        => 'numeric|required',
            'tithes'                                  => 'numeric|required',
            'connection'                              => 'numeric|required',
            'first_fruit'                             => 'numeric|required',
            'thanksgiving_offering'                   => 'numeric|required',
            'special_offering'                        => 'numeric|required',
            'project_offering'                        => 'numeric|required',
            'pos'                                     => 'numeric|required',
            'honourarium'                             => 'numeric|required',
            'others'                                  => 'numeric|required',
        ];
    }
}
