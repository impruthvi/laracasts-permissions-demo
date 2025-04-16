<?php

namespace App\Http\Requests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ];
    }

    // public function withValidator($validator)
    // {
    //     $validator->after(function ($validator) {
    //         if ($this->user()->id === $this->route('user')->id) {
    //             $adminRoleId = Role::where('auth_code', 'admin')->first()->id;

    //             if (!in_array($adminRoleId, $this->input('roles', []))) {
    //                 $validator->errors()->add(
    //                     'roles',
    //                     'You cannot remove the admin role from yourself.'
    //                 );
    //             }
    //         }
    //     });
    // }
}
