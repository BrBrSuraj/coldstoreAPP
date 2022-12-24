<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'role_id' => 'required',
            'name'=>'required|max:35',
            'email'=>'email|required|unique:users,email',
            'phone'=>'required|unique:users,phone',
            'address'=>'required|max:50',
        ];
    }
}
