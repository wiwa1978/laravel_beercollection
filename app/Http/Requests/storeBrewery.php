<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeBrewery extends FormRequest
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
            'brewery_name'=>'required|min:3|max:255',
            'brewery_zipcode'=>'required|min:3|max:255',
            'brewery_town'=>'required|min:3|max:255',
            'brewery_country'=>'required|min:3|max:255',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'brewery_name.required' => 'The name of the brewery is required',
            'brewery_zipcode.required' => 'The zipcode of the town where the brewery is located is required',
            'brewery_town.required'=> 'The town where the brewery is located required',
            'brewery_country.required'=> 'The country where the brewery is located is required',
        ];
    }
}
