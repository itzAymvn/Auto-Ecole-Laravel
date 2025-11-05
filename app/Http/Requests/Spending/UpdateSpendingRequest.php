<?php

namespace App\Http\Requests\Spending;

use App\Enums\SpendingType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateSpendingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('edit-spendings');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'type' => ['required', new Enum(SpendingType::class)],
            'amount' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'user_id.required' => __('The user field is required.'),
            'user_id.exists' => __('The selected user is invalid.'),
            'type.required' => __('The spending type field is required.'),
            'amount.required' => __('The amount field is required.'),
            'amount.numeric' => __('The amount must be a number.'),
            'amount.min' => __('The amount must be at least 0.'),
            'description.max' => __('The description must not exceed 1000 characters.'),
        ];
    }
}
