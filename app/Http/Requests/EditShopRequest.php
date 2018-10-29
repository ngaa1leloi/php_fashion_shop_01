<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditShopRequest extends FormRequest
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
            'name' => 'required|min:3|max:100|unique:shops,name,' . $this->id,
            'province' => 'required',
            'address' => 'required|min:10|max:100',
            'phone' => 'required|regex:/(0)[0-9]{9}$/',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('message.name_requỉred'),
            'name.min' => __('message.name_min'),
            'name.max' => __('message.name_max'),
            'name.unique' => __('message.name_unique'),
            'province.required' => __('message.province'),
            'address.required' => __('message.address'),
            'address.min' => __('message.address_min'),
            'address.max' => __('message.address_max'),
            'phone.required' => __('message.phone'),
            'phone.regex' => __('message.phone_regex'),
        ];
    }
}
