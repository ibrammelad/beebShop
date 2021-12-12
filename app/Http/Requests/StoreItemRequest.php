<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
          'status' => 'required|in:0,1',
          'is_offer' => 'required|in:0,1',
          'name'  =>  'required',
          'image' => 'required|image|mimes:jpeg,png,jpg' ,
          'description' => 'required' ,
          'quantity' => 'required|numeric' ,
          'quantity_type' => 'required' ,
          'price' => 'required|numeric' ,
          'discount' => 'required|numeric|min:0|max:2' ,
          'cost1' => 'required|numeric|lt:price' ,
          'cost2' => 'required|numeric|lt:price' ,
          'cost3' => 'required|numeric|lt:price' ,
          'category_id' => 'required|exists:categories,id' ,

        ];
    }
}
