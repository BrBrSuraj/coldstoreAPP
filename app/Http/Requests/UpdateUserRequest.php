<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'role_id' => 'required',
            'name' => 'required|max:35',
            'email' => ['email','required',Rule::unique('users')->ignore($this->user)],
            'phone' =>['required', Rule::unique('users')->ignore($this->user)],
            'address' => 'required|max:50',
        ];
    }
}
