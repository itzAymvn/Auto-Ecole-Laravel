<?php

namespace App\Http\Requests\Exam;

use App\Enums\ExamType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreExamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create-exams');
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
            'vehicle_id' => ['nullable', 'exists:vehicles,id'],
            'exam_type' => ['required', new Enum(ExamType::class)],
            'exam_title' => ['required', 'string', 'max:255'],
            'exam_date' => ['required', 'date', 'after_or_equal:today'],
            'exam_time' => ['required', 'date_format:H:i'],
            'exam_location' => ['required', 'string', 'max:500'],
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
            'vehicle_id.exists' => __('The selected vehicle is invalid.'),
            'exam_type.required' => __('The exam type field is required.'),
            'exam_title.required' => __('The exam title field is required.'),
            'exam_date.required' => __('The exam date field is required.'),
            'exam_date.after_or_equal' => __('The exam date must be today or later.'),
            'exam_time.required' => __('The exam time field is required.'),
            'exam_time.date_format' => __('The exam time format is invalid.'),
            'exam_location.required' => __('The exam location field is required.'),
        ];
    }
}
