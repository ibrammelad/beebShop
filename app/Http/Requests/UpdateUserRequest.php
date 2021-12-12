<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
//        'email' => 'max:55',
//        'image' => 'image|mimes:jpeg,png,jpg' ,
//        'is_driver' => 'in:0,1' ,
//        'is_helper' => 'in:0,1' ,

      ];
    }
}
