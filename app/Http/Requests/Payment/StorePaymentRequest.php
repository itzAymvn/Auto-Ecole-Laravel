<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create-payments');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_id' => ['required', 'exists:users,id'],
            'amount_paid' => ['required', 'numeric', 'min:0'],
            'goal_amount' => ['required', 'numeric', 'min:0', 'gte:amount_paid'],
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
            'student_id.required' => __('The student field is required.'),
            'student_id.exists' => __('The selected student is invalid.'),
            'amount_paid.required' => __('The amount paid field is required.'),
            'amount_paid.numeric' => __('The amount paid must be a number.'),
            'amount_paid.min' => __('The amount paid must be at least 0.'),
            'goal_amount.required' => __('The goal amount field is required.'),
            'goal_amount.numeric' => __('The goal amount must be a number.'),
            'goal_amount.min' => __('The goal amount must be at least 0.'),
            'goal_amount.gte' => __('The goal amount must be greater than or equal to the amount paid.'),
        ];
    }
}
