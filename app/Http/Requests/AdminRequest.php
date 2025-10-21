<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        $admin = $this->route('admin'); // poate fi null la creare
        $userId = $admin?->user->id ?? null;
        $method = $this->method();
        return [
            'full_name' => 'required|min:3',
            'phone' => 'nullable|regex:/^07[0-9]{8}$/',
            'status' => 'in:active,inactive',
            'user.email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId)
            ],
            'user.password' => $method === 'POST'
                ? 'required|min:8'
                : 'nullable|min:8'
        ];
    }
}
