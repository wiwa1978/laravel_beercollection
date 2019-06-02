<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeerItem extends FormRequest
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
            'item_name'=>'required',
            //'item_description'=> 'required',
            'category_id'=> 'required',
            'collection_id'=> 'required',
            'brewery_id'=> 'required',
            'amount_beeritems' => 'required',
            'wishlist' => 'required',
        ];

        /*
        switch($this->request->get('item_type')) {
            case 'beerglasses':
                 return [
                    'item_name'=>'required',
                    'item_description'=> 'required',
                    'category_id'=> 'required',
                    'collection_id'=> 'required',
                    'brewery_id'=> 'required',
                    'amount_beeritems' => 'required',
                    'wishlist' => 'required',
                ];
                break;
             case 'beerashtrays':
                 return [
                    'item_name'=>'required',

                ];
                break;
            case 'beerashtrays':
                 return [
                    'item_name'=>'required',

                ];
                break;
            case 'beerashtrays':
                 return [
                    'item_name'=>'required',

                ];
                break;
            case 'beerashtrays':
                 return [
                    'item_name'=>'required',

                ];
                break;
            case 'beerashtrays':
                 return [
                    'item_name'=>'required',

                ];
                break;
            case 'beerashtrays':
                 return [
                    'item_name'=>'required',

                ];
                break;
            case 'beerashtrays':
                 return [
                    'item_name'=>'required',

                ];
                break;
            case 'beerashtrays':
                 return [
                    'item_name'=>'required',

                ];
                break;
            case 'beerashtrays':
                 return [
                    'item_name'=>'required',

                ];
                break;

            default:
                return [
                    'item_name'=>'required',

                ];


        }
          */
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'item_name.required' => 'The name of the item is required',
            'item_description.required' => 'The description of the item is required',
            'category_id.required' => 'The category of the item is required!',
            'collection_id.required' => 'The collection to which the item belongs is required',
            'brewery_id.required' => 'The brewery to which the item belongs is required',
            'amount_beeritems.required' => 'The amount of items is required',
            'wishlist.required' => 'Whether this item belongs to your wishlist is required',
        ];
    }
}
