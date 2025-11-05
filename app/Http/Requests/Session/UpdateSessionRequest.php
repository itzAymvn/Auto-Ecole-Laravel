<?php

namespace App\Http\Requests\Session;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('edit-sessions');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'instructor_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'session_date' => ['required', 'date'],
            'session_time' => ['required', 'date_format:H:i'],
            'session_location' => ['required', 'string', 'max:500'],
            'is_completed' => ['boolean'],
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
            'instructor_id.required' => __('The instructor field is required.'),
            'instructor_id.exists' => __('The selected instructor is invalid.'),
            'title.required' => __('The title field is required.'),
            'session_date.required' => __('The session date field is required.'),
            'session_time.required' => __('The session time field is required.'),
            'session_time.date_format' => __('The session time format is invalid.'),
            'session_location.required' => __('The session location field is required.'),
        ];
    }
}
